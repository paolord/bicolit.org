<?php

use App\Storage\Post\PostEloquentRepository as Post;
use App\Service\Validation\LaravelValidator;

class AdminBlogsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;
    protected $validator;

    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post, LaravelValidator $validator)
    {
        parent::__construct();
        $this->post = $post;
        $this->validator = $validator;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/blogs/title.blog_management');

        // Grab all the blog posts
        $posts = $this->post;

        // Show the page
        return View::make('admin/blogs/index', compact('posts', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/blogs/title.create_a_new_blog');

        // Show the page
        return View::make('admin/blogs/create_edit', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
        $post = $this->post->create(Input::all());

        // Was the blog post created?
        if($post->result)
        {
            // Redirect to the new blog post page
            return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
        }

        return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/messages.create.error'))->withInput()->withErrors($post->errors);
	}

    /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getShow($post)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getEdit($post)
	{
        // Title
        $title = Lang::get('admin/blogs/title.blog_update');

        // Show the page
        return View::make('admin/blogs/create_edit', compact('post', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
	public function postEdit($post)
	{
        $post = $this->post->update($post->id, Input::all());

        // Was the blog post updated?
        if($post->result)
        {
            // Redirect to the new blog post page
            return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
        }

        return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'))->withInput()->withErrors($post->errors);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($post)
    {
        // Title
        $title = Lang::get('admin/blogs/title.blog_delete');

        // Show the page
        return View::make('admin/blogs/delete', compact('post', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($post)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $this->validator->make(Input::all(), $rules);

        // Check if the form validates with success
        if ($this->validator->passes())
        {
            $id = $post->id;

            $this->post->destroy($id);

            // Was the blog post deleted?
            //$post = $this->post->find($id);
            //if(empty($post))
            //{
                // Redirect to the blog posts management page
            //    return Redirect::to('admin/blogs')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            //}
        }
        // There was a problem deleting the blog post
        return Redirect::to('admin/blogs')->with('error', Lang::get('admin/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = $this->post->select(array('posts.id', 'posts.title', 'posts.created_at'));

        return Datatables::of($posts)

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe-delete">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}
