<?php

namespace Makeable\Youtube\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Makeable\Youtube\YoutubeServiceProvider;


class TestCase extends BaseTestCase
{
    /**
     */
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

//        $app->useEnvironmentPath(__DIR__.'/..');
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $app->register(YoutubeServiceProvider::class);

        config('services.google.credentials_file', __DIR__.'/../google_credentials.json');

//        $app->afterResolving('migrator', function ($migrator) {
//            $migrator->path(__DIR__.'/migrations/');
//        });

        return $app;
    }

}
