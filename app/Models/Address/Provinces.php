<?php


namespace App\Models\Address;


use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $guarded = [];

    protected $table="provinces";
    protected $fillable=["province_name","capital","no_of_districts",'area','image'];


    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
