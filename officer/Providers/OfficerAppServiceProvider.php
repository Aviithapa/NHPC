<?php


namespace officer\Providers;


use Illuminate\Support\ServiceProvider;

class OfficerAppServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(base_path('officer/resources/views'),'officer');
    }
}
