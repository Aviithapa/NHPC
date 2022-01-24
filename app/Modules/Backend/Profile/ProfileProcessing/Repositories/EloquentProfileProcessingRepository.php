<?php


namespace App\Modules\Backend\Profile\ProfileProcessing\Repositories;


use App\Models\Profile\Profilelogs;
use App\Models\Profile\ProfileProcessing;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Framework\RepositoryImplementation;

class EloquentProfileProcessingRepository extends RepositoryImplementation implements ProfileProcessingRepository
{
    public function getModel()
    {
        return new ProfileProcessing();
    }

    public function getAll()
    {
        return $this->getModel()->get();
    }

}
