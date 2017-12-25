<?php

namespace Infrastructure\Optimus\Distributed\src;

use Illuminate\Translation\TranslationServiceProvider as BaseTranslationServiceProvider;
use Infrastructure\Optimus\Distributed\src\Translation\DistributedFileLoader;
use Optimus\Api\System\Utilties;

class TranslationServiceProvider extends BaseTranslationServiceProvider
{
    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $config = $this->app['config']['optimus.components'];

        $paths = Utilities::findNamespaceResources(
            $config['namespaces'],
            $config['language_folder_name'],
            $config['resource_namespace']
        );

        $this->app->singleton('translation.loader', function ($app) use ($paths) {
            return new DistributedFileLoader($app['files'], $paths);
        });
    }
}
