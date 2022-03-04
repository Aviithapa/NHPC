<?php


namespace App\Models\AdmitCard;


use Illuminate\Database\Eloquent\Model;
use Student\Models\Profile;

class AdmitCard extends Model
{
    protected $table="admit_card";
    protected $fillable=["profile_id","exam_processing_id","symbol_number","is_taken",'created_by','updated_by'];

    public function getProfile(){
        return $this->hasOne(Profile::class,'id','profile_id');
    }
    public function getFirstName(){
        if(isset($this->getProfile->first_name)) {
            return $this->getProfile->first_name;
        }
        else {
            return '';
        }
    }
    public function getCitizenshipNumber(){
        if(isset($this->getProfile->first_name)) {
            return $this->getProfile->first_name;
        }
        else {
            return '';
        }
    }
}
