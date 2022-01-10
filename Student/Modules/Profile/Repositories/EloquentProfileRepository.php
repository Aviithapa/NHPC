<?php


namespace Student\Modules\Profile\Repositories;


use Student\Models\Profile;
use App\Modules\Framework\RepositoryImplementation;

class EloquentProfileRepository extends RepositoryImplementation implements ProfileRepository
{
    protected $entity_name="Profile";
    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return new Profile();
    }
}
