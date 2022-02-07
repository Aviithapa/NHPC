<?php


namespace Student\Models;


use App\Models\Admin\Level;
use App\Models\Admin\Program;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Qualification extends Model
{
    protected $table="registrant_qualification";

    protected $fillable = [
        'name', 'board_university', 'passed_year','admission_year','program_id','collage_id','user_id','level','registration_number',
        'transcript_image','provisional_image','character_image','ojt_image'
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
    public function getTranscriptImage()
    {
        return Storage::url('documents/' .$this->transcript_image);
    }
    public function getProvisionalImage()
    {
        return Storage::url('documents/' .$this->provisional_image);
    }
    public function getCharacterImage()
    {
        return Storage::url('documents/' .$this->character_image);
    }

    public function getOJTImage()
    {
        return Storage::url('documents/' .$this->ojt_image);
    }
}
