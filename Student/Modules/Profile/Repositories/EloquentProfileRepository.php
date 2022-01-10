<?php


namespace Student\Modules\Profile\Repositories;



use Student\Models\Profile;
use Student\Modules\Framework\RepositoryImplementation;

class EloquentProfileRepository extends RepositoryImplementation implements ProfileRepository
{
    protected $entity_name="profiles";
    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return new Profile();
    }
}
