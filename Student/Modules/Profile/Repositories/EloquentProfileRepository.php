<?php


namespace Student\Modules\Profile\Repositories;



use App\Models\Profile\Profilelogs;
use Illuminate\Support\Facades\Auth;
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

    public function getAllProfileList($id){
       $profile_logs = Profilelogs::all()->where('created_by','=', $id)->first();
       $profile = $this->getAll()->where('id','!=',$profile_logs['id']);
       return $profile;
    }



}
