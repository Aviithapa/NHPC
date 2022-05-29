<?php


namespace App\Modules\Backend\SubjectCommittee\SubjectCommitteRole;


use App\Models\SubjectCommittee\SubjectCommitteeUser;
use App\Modules\Backend\SubjectCommittee\SubjectCommittee\SubjectCommitteeRepository;
use App\Modules\Framework\RepositoryImplementation;

class EloquentSubjectCommitteeUserRepository  extends RepositoryImplementation implements  SubjectCommitteeUserRepository
{
    protected $entity_name = "subject_committee";

    /**
     * Gets model for operation.
     *
     * @return mixed
     */
    public function getModel()
    {
        return new SubjectCommitteeUser();
    }




}
