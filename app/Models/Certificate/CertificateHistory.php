<?php


namespace App\Models\Certificate;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CertificateHistory extends Model
{

    protected $table = 'certificate';
    protected $fillable = [
        'profile_photo', 'name', 'date_of_birth',
        'program_code',
        'srn', 'ward', 'municipality', 'district', 'province', 'level', 'registration_number', 'date_of_issue', 'qualification', 'insitutate', 'passed_year',
        'registrar', 'valid_till', 'certificate', 'type',
        'remarks', 'is_printed', 'printed_date',
        'printed_by', 'is_edited', 'issued_by', 'certificate_status', 'decision_date'
    ];

    public function getProfileImage()
    {
        if (isset($this->profile_photo)) {
            return Storage::url('documents/' . $this->profile_photo);
        } else {
            return imageNotFound();
        }
    }
}
