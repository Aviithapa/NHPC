<?php


namespace App\Modules\Backend\Exam\ExamProcessing\Repositories;


use App\Models\Exam\ExamProcessing;
use App\Modules\Framework\RepositoryImplementation;

class EloquentExamProcessingRepository extends RepositoryImplementation implements ExamProcessingRepository
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
    return new ExamProcessing();
    }
}
