<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Collage extends Model
{
    protected $table="college";
    protected $fillable=["name","slug","development_region_id",
                        "zone_id","district_id","vdc_municipality",
                        "ward_number","tol","phone_number",
                        "college_type","university_id","registration_status",
                        "college_type","university_id","registration_status",
        'approved_by','approved_date'];

}
