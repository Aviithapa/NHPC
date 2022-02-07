<?php


namespace Student\Modules\Qualification\Repositories;



use Student\Models\Qualification;
use Student\Modules\Framework\RepositoryImplementation;

class EloquentQualificationRepository extends RepositoryImplementation implements QualificationRepository
{
    protected $entity_name="profiles";
    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return new Qualification();
    }

    public function slcData($id){
        return $this->getAll()->where('user_id','=',$id)
            ->where('level','=','1')
            ->isEmpty();
    }
    public function tslcData($id){
        return $this->getAll()->where('user_id','=',$id)
            ->where('level','=','2')
            ->isEmpty();
    }
    public function pclData($id){
        return $this->getAll()->where('user_id','=',$id)
            ->where('level','=','3')
            ->isEmpty();
    }

    public function bachelorData($id){
        return $this->getAll()->where('user_id','=',$id)
            ->where('level','=','4')
            ->isEmpty();
    }

    public function masterData($id){
        return $this->getAll()->where('user_id','=',$id)
            ->where('level','=','5')
            ->isEmpty();
    }
}
