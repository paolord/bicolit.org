<?php namespace App\Service;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'App\Service\Cache\CacheInterface',
            'App\Service\Cache\LaravelCache',
            'App\Service\Validation\ValidableInterface',
            'App\Service\Validation\LaravelValidator'
        );
    }

}
