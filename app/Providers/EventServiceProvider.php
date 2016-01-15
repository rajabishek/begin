<?php

namespace Begin\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Begin\Events\SomeEvent' => [
            'Begin\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $this->app['events']->listen('tymon.jwt.expired', function()
        {
            return response()->json(['success' => false,'errors' => ['Your token has expired']], 401);
        });

        $this->app['events']->listen('tymon.jwt.invalid', function()
        {
            return response()->json(['success' => false,'errors' => ['Your token is invalid']], 400);
        });

        $this->app['events']->listen('tymon.jwt.absent', function()
        {
            return response()->json(['success' => false,'errors' => ['Please provide a token']],400);
        });
    }
}
