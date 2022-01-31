<?php


namespace Council\Providers;


use Illuminate\Support\ServiceProvider;

class CouncilAppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(base_path('Council/resources/views'),'council');
    }
}
