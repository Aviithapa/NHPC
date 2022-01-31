<?php


namespace App\Models\Exam;


use Illuminate\Database\Eloquent\Model;

class ExamProcessingDetails extends Model
{
    protected $table='exam_processing_details';
    protected $fillable=['exam_processing_id','profile_id','state',
        'status','remarks','review_status','created_by'];

}
