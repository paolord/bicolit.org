<?php namespace App\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'App\Storage\Page\PageRepositoryInterface',
            'App\Storage\Post\PostRepositoryInterface'
        );
    }

}
