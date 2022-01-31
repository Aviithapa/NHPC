<?php


namespace App\Modules\Backend\Exam\ExamProcessingDetails\Repositories;


use App\Models\Exam\ExamProcessingDetails;
use App\Modules\Framework\RepositoryImplementation;

class EloquentExamProcessingDetailsRepository extends RepositoryImplementation implements ExamProcessingDetailsRepository
{
    public function getModel()
    {
        return new ExamProcessingDetails();
    }

    public function getAll()
    {
        return $this->getModel()->get();
    }

}
