<?php


namespace App\Models\Address;


use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $guarded = [];

    public $incrementing = false;
    public $keyType = 'string';
    protected $table='municipalities';
    protected $fillable=['district_name','name'];

    // Municipality Belongs To District Relation

    public function district()
    {
        return $this->belongsTo(District::class, 'district_name');
    }
}
