<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
   protected $table="level";
   protected $fillable=["name","level_","level_number","level_nepali","level_code",'higher_section','created_by','sub_delete','created_date'];
}
