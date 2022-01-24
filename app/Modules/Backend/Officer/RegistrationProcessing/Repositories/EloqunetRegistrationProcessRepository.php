<?php


namespace App\Modules\Backend\Officer\RegistrationProcessing\Repositories;


use App\Models\officer\RegistrationProcessDetails;
use App\Modules\Framework\RepositoryImplementation;

class EloqunetRegistrationProcessRepository extends RepositoryImplementation implements RegistrationProcessRepository
{

    public function perPage()
    {
        $page = 10;
        return $page?$page:10;
    }

    public function getModel()
    {
        return new RegistrationProcessDetails();
    }

    public function getAll()
    {
        return $this->getModel()->get();
    }
}
