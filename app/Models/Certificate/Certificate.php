<?php


namespace App\Models\Certificate;


use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
   protected $table = 'certificate_history';
   protected $fillable=['registration_id','category_id','program_id',
       'program_certificate_code',
       'srn','cert_registration_number',
       'registrar','decision_date','name',
       'date_of_birth','address','program_name','level_name',
       'qualification','issued_year','issued_date',
       'profile_id',
       'valid_till','certificate','type',
       'remarks','is_printed','printed_date',
       'printed_by','is_edited','issued_by','certificate_status'];
}
