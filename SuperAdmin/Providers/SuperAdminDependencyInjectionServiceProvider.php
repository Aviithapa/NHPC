<?php


namespace SuperAdmin\Providers;


use App\Modules\Backend\Website\Blog\Repositories\BlogRepository;
use App\Modules\Backend\Website\Blog\Repositories\EloquentBlogRepository;
use App\Modules\Backend\Website\Contact\Repositories\ContactRepository;
use App\Modules\Backend\Website\Contact\Repositories\EloquentContactRepository;
use App\Modules\Backend\Website\Event\Repositories\EloquentEventRepository;
use App\Modules\Backend\Website\Event\Repositories\EventRepository;
use App\Modules\Backend\Website\Post\Repositories\EloquentPostRepository;
use App\Modules\Backend\Website\Post\Repositories\PostRepository;
use Student\Providers\StudentServiceProvider;

class SuperAdminDependencyInjectionServiceProvider extends StudentServiceProvider
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

        /**
         * Site Setting dependency
         */
        $this->app->bind(
            \App\Modules\Backend\Settings\SiteSetting\Repositories\SiteSettingRepository::class,
            \App\Modules\Backend\Settings\SiteSetting\Repositories\EloquentSiteSettingRepository::class
        );

        /**
         * Slider dependency
         */
        $this->app->bind(
            \App\Modules\Backend\Website\Slider\Repositories\SliderRepository::class,
            \App\Modules\Backend\Website\Slider\Repositories\EloquentSliderRepository::class
        );
        /**
        CMS
         * Banner dependency
         */
        $this->app->bind(
            PostRepository::class,
            EloquentPostRepository::class
        );
        /**CMS
         * Banner dependency
         */
        $this->app->bind(
            PostRepository::class,
            EloquentPostRepository::class
        );


        $this->app->bind(
            EventRepository::class,
            EloquentEventRepository::class
        );


        $this->app->bind(
            ContactRepository::class,
            EloquentContactRepository::class
        );
        $this->app->bind(
            BlogRepository::class,
            EloquentBlogRepository::class
        );


    }
}
