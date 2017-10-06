<?php

namespace Makeable\Youtube;

use Google_Client;
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
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(YoutubeClient::class, function () {
            return tap(new Google_Client, function ($client) {
                $client->setApplicationName(config('app.name'));
                $client->setAuthConfig(config('services.google.credentials_file'));
            });
        });
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
