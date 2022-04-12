<?php

namespace App\Modules\Backend\Address\Repositories;

use App\Models\Address\Municipality;
use App\Models\Admin\Collage;
use App\Modules\Framework\RepositoryImplementation;

class EloquentMunicipalityRepository extends RepositoryImplementation implements MunicipalityRepository
{

    public function getModel()
    {
        return new Municipality();
    }

}
