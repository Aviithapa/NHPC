<?php


namespace Student\Models;


use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table="registrant_qualification";

    protected $fillable = [
        'name', 'board_university', 'passed_year','admission_year','program_id','collage_id','user_id','level','registration_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}
