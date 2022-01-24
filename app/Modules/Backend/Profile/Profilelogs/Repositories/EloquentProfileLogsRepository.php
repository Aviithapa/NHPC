<?php


namespace App\Modules\Backend\Profile\Profilelogs\Repositories;


use App\Models\Profile\Profilelogs;
use App\Modules\Framework\RepositoryImplementation;

class EloquentProfileLogsRepository extends RepositoryImplementation implements ProfileLogsRepository
{
    public function getModel()
    {
        return new Profilelogs();
    }

    public function getAll()
    {
        return $this->getModel()->get();
    }

}
