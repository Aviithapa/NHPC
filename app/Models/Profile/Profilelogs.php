<?php


namespace App\Models\Profile;


use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Profilelogs extends Model
{
    protected $table='profile_logs';
    protected $fillable=['profile_id','state',
        'status','remarks','review_status','created_by'];

    public function getUser(){
        return $this->hasOne(User::class,'id','created_by');
    }

    public function getUserName(){
        if(isset($this->getUser->name)) {
            return $this->getUser->name;
        }
        else {
            return '';
        }
    }
}
