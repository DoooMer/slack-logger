<?php

namespace App\Providers;

use App\Services\SlackApiService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SlackApiService::class, function () {
            $client = new Client([
                'base_uri' => config('services.slack.url'),
            ]);
            return new SlackApiService($client);
        });
    }
}
