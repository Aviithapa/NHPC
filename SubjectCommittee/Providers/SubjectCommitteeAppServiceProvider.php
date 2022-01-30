<?php


namespace SubjectCommittee\Providers;


use Illuminate\Support\ServiceProvider;

class SubjectCommitteeAppServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(base_path('SubjectCommittee/resources/views'),'subjectCommittee');
    }
}
