<?php


namespace App\Models\SubjectCommittee;


use Illuminate\Database\Eloquent\Model;

class SubjectCommitteeUser extends  Model
{
    protected $table="subject_committee_user";
    protected $fillable=["user_id","subject_committee_id"];

}
