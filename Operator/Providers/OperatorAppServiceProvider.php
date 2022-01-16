<?php


namespace Operator\Providers;


use Illuminate\Support\ServiceProvider;

class OperatorAppServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(base_path('Operator/resources/views'),'operator');
    }
}
