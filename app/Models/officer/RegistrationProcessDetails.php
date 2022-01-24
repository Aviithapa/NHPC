<?php


namespace App\Models\officer;


use Illuminate\Database\Eloquent\Model;

class RegistrationProcessDetails extends Model
{
     protected $table='registration_process_details';
     protected $fillable=['registration_processing_id','registration_id',
         'category_id','state_','status_','remarks','created_by','review_status','sub_delete','created_date'];

}
