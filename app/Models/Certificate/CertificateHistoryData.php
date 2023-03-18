<?php


namespace App\Models\Certificate;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CertificateHistoryData extends Model
{

    protected $table = 'certificate_history_data_back';
    protected $fillable = [
        'profile_id',
        'profile_picture',
        'municipality',
        'email',
        'phone_number',
        'qualification',
        'gender',
        'collage_name',
        'passed_year',
        'ward',
        'municipality',
        'district',
        'province',
        'insitutate',
        'program_code',
        'qualification'
    ];

    public function getProfileImage()
    {
        if (isset($this->profile_picture)) {
            return Storage::url('documents/' . $this->profile_picture);
        } else {
            return imageNotFound();
        }
    }
}
