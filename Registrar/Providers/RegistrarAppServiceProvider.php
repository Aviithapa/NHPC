<?php


namespace Registrar\Providers;


use Illuminate\Support\ServiceProvider;

class RegistrarAppServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(base_path('Registrar/resources/views'),'registrar');
    }
}
