<?php namespace App\Storage\Post;

use Str;
use Auth;
use Post;
use App\Service\Cache\CacheInterface;

class PostEloquentRepository implements PostRepositoryInterface
{
    protected $data;
    protected $cache;
    protected $cache_name;

    public function __construct(Post $data, CacheInterface $cache)
    {
        $this->data = $data;
        $this->cache = $cache;
        $this->cache_name = 'post';
    }

    public function newInstance(array $attributes = array())
    {
        return $this->data->newInstance($attributes);
    }

    public function paginate($perPage = 0, $columns = array('*'))
    {
        $perPage = 10;
        return $this->data->paginate($perPage, $columns);
    }

    public function select($columns = array('*'))
    {
        return $this->data->select($columns);
    }

    public function all()
    {
        return $this->data->all();
    }

    public function create($attributes)
    {
        $data = new \StdClass;
        $user = Auth::user();

        $this->data->title            = $attributes['title'];
        $this->data->slug             = Str::slug($attributes['title']);
        $this->data->content          = $attributes['content'];
        $this->data->meta_title       = $attributes['meta-title'];
        $this->data->meta_description = $attributes['meta-description'];
        $this->data->meta_keywords    = $attributes['meta-keywords'];
        $this->data->user_id          = $user->id;

        $data->result = $this->data->save();
        $data->id = $this->data->id;
        $data->errors = $this->data->errors();

        $key = md5($this->cache_name.'.'.$this->data->slug);
        $this->cache->put($key, $this->data);

        return $data;
    }

    public function find($id, $columns = array('*'))
    {
        return $this->data->findOrFail($id, $columns);
    }

    public function orderBy($column, $order = 'ASC')
    {
        return $this->data->orderBy($column, $order);
    }

    public function where($column, $operator, $condition)
    {
        $key = md5($this->cache_name.'.'.$condition);

        if( $this->cache->has($key) )
        {
            return $this->cache->get($key);
        }
        else
        {
            $data = $this->data->where($column, $operator, $condition)->first();
            $this->cache->put($key, $data);

            return $data;
       }
    }

    public function update($id, array $attributes)
    {
        $data = new \StdClass;
        $record = $this->data->find($id);

        $key = md5($this->cache_name.'.'.$record->slug );
        $this->cache->forget($key);

        $record->title            = $attributes['title'];
        $record->slug             = Str::slug($attributes['title']);
        $record->content          = $attributes['content'];
        $record->meta_title       = $attributes['meta-title'];
        $record->meta_description = $attributes['meta-description'];
        $record->meta_keywords    = $attributes['meta-keywords'];

        $data->result = $record->save();
        $data->id = $record->id;
        $data->errors = $record->errors();

        $key = md5($this->cache_name.'.'.$record->slug );
        $this->cache->put($key, $record);

        return $data;
    }

    public function destroy($id)
    {
        $record = $this->data->find($id);
        $key = md5($this->cache_name.'.'.$record->slug);

        if( $this->cache->has($key) )
        {
            $this->cache->forget($key);
        }

        return $this->data->destroy($id);
    }
}
