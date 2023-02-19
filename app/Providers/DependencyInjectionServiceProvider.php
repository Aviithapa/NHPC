<?php

namespace App\Providers;

use App\Modules\Backend\Address\Repositories\EloquentMunicipalityRepository;
use App\Modules\Backend\Address\Repositories\MunicipalityRepository;
use App\Modules\Backend\Admin\Category\Repositories\CategoryRepository;
use App\Modules\Backend\Admin\Category\Repositories\EloquentCategoryRepository;
use App\Modules\Backend\Admin\College\Repositories\CollegeRepository;
use App\Modules\Backend\Admin\College\Repositories\EloquentCollageRepository;
use App\Modules\Backend\Admin\Level\Repositories\EloquentLevelRepository;
use App\Modules\Backend\Admin\Level\Repositories\LevelRepository;
use App\Modules\Backend\Admin\Program\Repositories\EloquentProgramRepository;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\AdmitCard\Repositories\AdmitCardRepository;
use App\Modules\Backend\AdmitCard\Repositories\EloquentAdmitCardRepository;
use App\Modules\Backend\Certificate\Repositories\CertificateRepository;
use App\Modules\Backend\CertificateHistory\Repositories\EloquentCertificateHistoryRepository;
use App\Modules\Backend\Certificate\Repositories\EloquentCertificateRepository;
use App\Modules\Backend\CertificateHistory\Repositories\CertificateHistoryRepository;
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
use App\Modules\Backend\Result\Repositories\EloquentExamResultRepository;
use App\Modules\Backend\Result\Repositories\ExamResultRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommittee\EloquentSubjectCommitteeRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommittee\SubjectCommitteeRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommitteRole\EloquentSubjectCommitteeUserRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommitteRole\SubjectCommitteeUserRepository;
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

        $this->app->bind(
            ExamResultRepository::class,
            EloquentExamResultRepository::class,
        );

        $this->app->bind(
            CertificateRepository::class,
            EloquentCertificateRepository::class,
        );

        $this->app->bind(
            CollegeRepository::class,
            EloquentCollageRepository::class
        );

        $this->app->bind(
            MunicipalityRepository::class,
            EloquentMunicipalityRepository::class
        );

        $this->app->bind(
            SubjectCommitteeUserRepository::class,
            EloquentSubjectCommitteeUserRepository::class,
        );

        $this->app->bind(
            SubjectCommitteeRepository::class,
            EloquentSubjectCommitteeRepository::class
        );

        $this->app->bind(
            CertificateHistoryRepository::class,
            EloquentCertificateHistoryRepository::class
        );
    }
}
