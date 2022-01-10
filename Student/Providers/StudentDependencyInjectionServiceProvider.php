<?php

namespace Student\Providers;

use Student\Modules\Profile\Repositories\EloquentProfileRepository;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Providers\StudentServiceProvider;

class StudentDependencyInjectionServiceProvider extends StudentServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * User dependency
         */
        $this->app->bind(
             ProfileRepository::class,
            EloquentProfileRepository::class
        );





    }
}
