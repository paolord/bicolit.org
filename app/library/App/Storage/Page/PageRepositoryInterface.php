<?php namespace App\Storage\Page;

interface PageRepositoryInterface
{
    public function all();

    public function select($columns = array('*'));

    public function newInstance(array $attributes = array());

    public function paginate($perPage = 15, $columns = array('*'));

    public function create($attributes);

    public function find($id, $columns = array('*'));

    public function orderBy($column, $order = 'ASC');

    public function where($column, $operator, $condition);

    public function update($id, array $attributes);

    public function destroy($id);
}
