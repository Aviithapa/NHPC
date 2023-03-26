<?php


namespace App\Models\Certificate;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class KYCData extends Model
{

    protected $table = 'kyc_data';
    protected $fillable = [
        'name', 'profile_id', 'dob', 'symbol_number', 'profile_img'
    ];

    public function getProfileImage()
    {
        if (isset($this->profile_img)) {
            return Storage::url('documents/' . $this->profile_img);
        } else {
            return imageNotFound();
        }
    }
}
