<?php


namespace App\Modules\Backend\Admin\College\Repositories;


use App\Models\Admin\Collage;
use App\Modules\Framework\RepositoryImplementation;

class EloquentCollageRepository extends RepositoryImplementation implements CollegeRepository
{
    public function getModel()
    {
        return new Collage();
    }
}
