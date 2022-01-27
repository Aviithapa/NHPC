<?php


namespace App\Modules\Backend\Exam\Exam\Repositories;


use App\Models\Exam\Exam;
use App\Modules\Framework\RepositoryImplementation;

class EloquentExamRepository extends RepositoryImplementation implements ExamRepository
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return new Exam();
    }
}
