<?php


namespace Student\Models;


use App\Models\Admin\Level;
use App\Models\Admin\Program;
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

    public function getLevel(){
        return $this->hasOne(Level::class,'id','level');
    }

    public function getLevelName(){
        return $this->getLevel->name;
    }


    public function getProgram(){
        return $this->hasOne(Program::class,'id','program_id');
    }

    public function getProgramName(){
        return $this->getProgram->name;
    }

}
