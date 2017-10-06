<?php
/**
 * Created by PhpStorm.
 * User: troels
 * Date: 06/10/2017
 * Time: 08.09
 */

namespace Makeable\Youtube;

use Illuminate\Support\ServiceProvider;

class YoutubeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
//        $this->publishes(array(__DIR__ . '/config/youtube.php' => config_path('youtube.php')));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(YoutubeClient::class, function () {
            return new YoutubeClient(config('services.google.credentials_file'));
        });

//        $this->app->bind('youtube', function () {
//            return new Youtube(config('youtube.key'));
//        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [YoutubeClient::class];
    }
}
