<?php


namespace App\Models\AdmitCard;


use Illuminate\Database\Eloquent\Model;

class AdmitCard extends Model
{
    protected $table="admit_card";
    protected $fillable=["profile_id","exam_processing_id","symbol_number","is_taken",'created_by','updated_by'];

}
