<?php


namespace App\Models\SubjectCommittee;


use Illuminate\Database\Eloquent\Model;

class SubjectCommitteeUser extends  Model
{
    protected $table="subject_committee_user";
    protected $fillable=["user_id","subjecr_committee_id","signature_image",'coordinator'];

    public function getSignatureImage(){
        if(isset($this->signature_image)) {
            return $this->signature_image;
        }
        else {
            return '';
        }
    }
}
