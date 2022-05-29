<?php


namespace App\Models\SubjectCommittee;


use Illuminate\Database\Eloquent\Model;

class SubjectCommitteeUser extends  Model
{
    protected $table="subject_committee_user";
    protected $fillable=["user_id","subject_committee_id","signature_image"];

    public function getSignatureImage(){
        if(isset($this->signature_image)) {
            return $this->signature_image;
        }
        else {
            return '';
        }
    }
}
