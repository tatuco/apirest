<?php

namespace Infrastructure\Optimus\ApiConsumer\src\Provider;

use Illuminate\Support\ServiceProvider as BaseProvider;
use Infrastructure\Optimus\ApiConsumer\src\Router;

class LaravelServiceProvider extends BaseProvider {

    public function register()
    {

    }

    public function boot()
    {
        $this->app->singleton('apiconsumer', function(){
            $app = app();

            return new Router($app, $app['request'], $app['router']);
        });
    }

}
