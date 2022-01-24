<?php


namespace App\Models\Profile;


use Illuminate\Database\Eloquent\Model;

class ProfileProcessing extends Model
{
    protected $table='profile_processing';
    protected $fillable=['profile_id','current_state',
        'status','remarks'];
}
