<?php


namespace App\Models\AdmitCard;


use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $table="exam_result";
    protected $fillable=["symbol_number","status","remarks"];

}
