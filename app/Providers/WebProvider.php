<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WebProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['web.block._sidebar', 'web.block._sidebar_i9'],
            'App\Http\ViewComposers\Web\SidebarComposer'
        );
        view()->composer(
            ['web.header', 'web.footer'],
            'App\Http\ViewComposers\Web\MenuComposer'
        );
    }
}
