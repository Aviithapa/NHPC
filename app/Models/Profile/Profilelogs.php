<?php


namespace App\Models\Profile;


use Illuminate\Database\Eloquent\Model;

class Profilelogs extends Model
{
    protected $table='profile_logs';
    protected $fillable=['profile_id','state',
        'status','remarks','review_status','created_by'];

}
