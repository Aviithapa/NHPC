<?php


namespace App\Models\Exam;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ExamProcessing extends Model
{

     protected $table='exam_registration';
     protected $fillable=['exam_id','profile_id','voucher_image'];


    public function getExam(){
        return $this->hasOne(Exam::class,'id','exam_id');
    }

    public function getExamName(){
        return $this->getExam->Exam_name;
    }

    public function getVoucherImage(){
        return Storage::url('documents/' .$this->voucher_image);
    }


}
