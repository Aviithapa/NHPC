<?php

namespace App\Providers;

use App\Modules\Backend\Admin\Category\Repositories\CategoryRepository;
use App\Modules\Backend\Admin\Category\Repositories\EloquentCategoryRepository;
use App\Modules\Backend\Admin\Level\Repositories\EloquentLevelRepository;
use App\Modules\Backend\Admin\Level\Repositories\LevelRepository;
use App\Modules\Backend\Admin\Program\Repositories\EloquentProgramRepository;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\AdmitCard\Repositories\AdmitCardRepository;
use App\Modules\Backend\AdmitCard\Repositories\EloquentAdmitCardRepository;
use App\Modules\Backend\Exam\Exam\Repositories\EloquentExamRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\EloquentExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\EloquentExamProcessingDetailsRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\EloquentProfileLogsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\EloquentProfileProcessingRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
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

          $this->app->bind(
              ProfileProcessingRepository::class,
              EloquentProfileProcessingRepository::class,

          );


        $this->app->bind(
            ProfileLogsRepository::class,
            EloquentProfileLogsRepository::class
          );

        $this->app->bind(
            ExamRepository::class,
            EloquentExamRepository::class
        );

        $this->app->bind(
            ExamProcessingRepository::class,
            EloquentExamProcessingRepository::class
        );

        $this->app->bind(
            ExamProcessingDetailsRepository::class,
              EloquentExamProcessingDetailsRepository::class
        );

        $this->app->bind(
            AdmitCardRepository::class,
            EloquentAdmitCardRepository::class,
        );
    }
}
