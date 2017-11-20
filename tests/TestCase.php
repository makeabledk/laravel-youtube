<?php

namespace Makeable\LaravelYoutube\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Makeable\LaravelYoutube\YoutubeServiceProvider;


class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('APP_ENV=testing');
        putenv('APP_DEBUG=true');
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_DATABASE=:memory:');

        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $app->register(YoutubeServiceProvider::class);

//        config('services.google.token', file_get_contents(__DIR__.'/../token'));
//        config('services.google.credentials_file', __DIR__.'/../google_credentials.json');

        return $app;
    }
}
