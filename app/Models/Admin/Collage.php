<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Collage extends Model
{
    protected $table="college";
    protected $fillable=["name",
                        "district_id",
                        "college_type","university_id","registration_status",
        'updated_at'];

}
