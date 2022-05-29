<?php


namespace App\Modules\Backend\SubjectCommittee\SubjectCommittee;


use App\Models\SubjectCommittee\SubjectCommittee;
use App\Modules\Framework\RepositoryImplementation;

class EloquentSubjectCommitteeRepository extends RepositoryImplementation implements  SubjectCommitteeRepository
{
    protected $entity_name = "subject_committee";

    /**
     * Gets model for operation.
     *
     * @return mixed
     */
    public function getModel()
    {
        return new SubjectCommittee();
    }




}
