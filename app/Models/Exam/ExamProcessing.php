<?php


namespace App\Models\Exam;


use App\Models\Admin\Level;
use App\Models\Admin\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Student\Models\Profile;

class ExamProcessing extends Model
{

     protected $table='exam_registration';
     protected $fillable=['exam_id','profile_id','voucher_image','program_id','level_id','state','status','remarks','subject_committee_count','is_admit_card_generate'];


    public function getExam(){
        return $this->hasOne(Exam::class,'id','exam_id');
    }

    public function getExamName(){
        return $this->getExam->Exam_name;
    }

    public function getProfile(){
        return $this->hasOne(Profile::class,'id','profile_id');
    }

    public function getFirstName(){
        $name= $this->getProfile->first_name  ;
        return $name;
    }

    public function getMiddleName(){
        $name= $this->getProfile->middle_name  ;
        return $name;
    }

    public function getLastName(){
        $name= $this->getProfile->last_name  ;
        return $name;
    }

    public function getGender(){
        $name= $this->getProfile->sex  ;
        return $name;
    }

    public function level(){
        $level = $this->hasOne(Level::class,'id','level_id');
        return $level;
    }

    public  function  getLevelName(){
        $name = $this->level->name;
        return $name;
    }


    public function program(){
        $level = $this->hasOne(Program::class,'id','program_id');
        return $level;
    }

    public  function  getProgramName(){
        $name = $this->program->name;
        return $name;
    }
    public function getProfileImage(){
        return Storage::url('documents/' .$this->getProfile->profile_picture);
    }
    public function getVoucherImage(){
        return Storage::url('documents/' .$this->voucher_image);
    }


}
