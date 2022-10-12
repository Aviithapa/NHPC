<?php


namespace App\Modules\Backend\Admin\Program\Repositories;


use App\Models\Admin\Program;

use App\Modules\Framework\RepositoryImplementation;

use Illuminate\Support\Facades\Log;

class EloquentProgramRepository extends RepositoryImplementation implements ProgramRepository
{
    

    public function getModel()
    {
        return new Program();
    }

}
