<?php

namespace Makeable\LaravelYoutube;

use Google_Client;
use Illuminate\Support\ServiceProvider;

class YoutubeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(YoutubeClient::class, function () {
            return tap(new Google_Client, function ($client) {
                $client->setApplicationName(config('app.name'));
                $client->setAuthConfig([
                    'client_id' => config('services.google.oauth_client_id'),
                    'client_secret' => config('services.google.oauth_client_secret'),
                ]);
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
