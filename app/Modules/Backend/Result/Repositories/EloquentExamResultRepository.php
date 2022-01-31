<?php


namespace App\Modules\Backend\Result\Repositories;

use App\Models\AdmitCard\ExamResult;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Framework\RepositoryImplementation;

class EloquentExamResultRepository extends RepositoryImplementation implements ExamResultRepository
{
    public function getModel()
    {
        return new ExamResult();
    }
}
