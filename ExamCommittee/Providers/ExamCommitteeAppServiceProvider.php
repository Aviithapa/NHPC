<?php


namespace ExamCommittee\Providers;


use Illuminate\Support\ServiceProvider;

class ExamCommitteeAppServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(base_path('ExamCommittee/resources/views'),'examCommittee');
    }
}
