<?php

namespace App\Providers;

use App\Modules\Backend\Admin\Category\Repositories\CategoryRepository;
use App\Modules\Backend\Admin\Category\Repositories\EloquentCategoryRepository;
use App\Modules\Backend\Admin\Level\Repositories\EloquentLevelRepository;
use App\Modules\Backend\Admin\Level\Repositories\LevelRepository;
use App\Modules\Backend\Admin\Program\Repositories\EloquentProgramRepository;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use Illuminate\Support\ServiceProvider;

class DependencyInjectionServiceProvider extends ServiceProvider
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
            \App\Modules\Backend\Authentication\User\Repositories\UserRepository::class,
            \App\Modules\Backend\Authentication\User\Repositories\EloquentUserRepository::class
        );

        /**
         * Permission dependency
         */
        $this->app->bind(
            \App\Modules\Backend\Authentication\Permission\Repositories\PermissionRepository::class,
            \App\Modules\Backend\Authentication\Permission\Repositories\EloquentPermissionRepository::class
        );

        /**
         * Role dependency
         */
        $this->app->bind(
            \App\Modules\Backend\Authentication\Role\Repositories\RoleRepository::class,
            \App\Modules\Backend\Authentication\Role\Repositories\EloquentRoleRepository::class
        );


          $this->app->bind(
                LevelRepository::class,
                EloquentLevelRepository::class
          );

          $this->app->bind(
              ProgramRepository::class,
              EloquentProgramRepository::class
          );
          $this->app->bind(
              CategoryRepository::class,
              EloquentCategoryRepository::class
          );
    }
}
