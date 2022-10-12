<?php


namespace App\Models\Exam;


use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
   protected $table="exam";
   protected $fillable=['Exam_name','form_opening_date','form_closing_date','exam_date','Level_id','description','status'];
}
