<?php


namespace App\Modules\Backend\AdmitCard\Repositories;


use App\Models\AdmitCard\AdmitCard;
use App\Modules\Framework\RepositoryImplementation;

class EloquentAdmitCardRepository extends RepositoryImplementation implements AdmitCardRepository
{
    public function getModel()
    {
        return new AdmitCard();
    }
}
