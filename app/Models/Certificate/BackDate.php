<?php


namespace App\Models\Certificate;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BackDate extends Model
{

    protected $table = 'date_update';
    protected $fillable = [
        'certificate_id', 'profile_id', 'update_date', 'expire_at'
    ];
}
