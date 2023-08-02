<?php

namespace Student\Models;

use App\Models\Address\Provinces;
use App\Models\Admin\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class Profile extends  Model
{
    protected $table = "profiles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'first_name_nep',
        'middle_name_nep',
        'last_name_nep',
        'dob_eng',
        'dob_nep',
        'sex',
        'ethinic',
        'cast',
        'marital_status',
        'citizenship_number',
        'citizenship_issue_date',
        'issue_district',
        'father_name',
        'father_name_nep',
        'grandfather_name',
        'grandfather_name_nep',
        'mother_name',
        'mother_name_nep',
        'development_region',
        'zone',
        'district',
        'vdc_municiplality',
        'ward_no',
        'admission_year',
        'collage_name',
        'program_name',
        'registration_number',
        'hospital_name',
        'is_registrated',
        'husband_wife_name',
        'profile_picture',
        'citizenship_front',
        'citizenship_back',
        'signature_image',
        'ojt_image',
        'counil_name',
        'user_id',
        'registration_date',
        'registration_number',
        'registration_subject',
        'registration_level',
        'profile_status',
        'level',
        'profile_state',
    ];

    public function getProfileImage()
    {
        if (isset($this->profile_picture)) {
            return Storage::url('documents/' . $this->profile_picture);
        } else {
            return imageNotFound();
        }
    }
    public function getCitizenshipFrontImage()
    {
        if (isset($this->citizenship_front)) {
            return Storage::url('documents/' . $this->citizenship_front);
        } else {
            return imageNotFound();
        }
    }
    public function getCitizenshipBackImage()
    {
        if (isset($this->citizenship_back)) {
            return Storage::url('documents/' . $this->citizenship_back);
        } else {
            return imageNotFound();
        }
    }
    public function getSignatureImage()
    {
        if (isset($this->signature_image)) {
            return Storage::url('documents/' . $this->signature_image);
        } else {
            return imageNotFound();
        }
    }

    public function getLevel()
    {
        return $this->hasOne(Level::class, 'id', 'registration_level');
    }

    public function getProvince()
    {
        return $this->hasOne(Provinces::class, 'id', 'development_region');
    }

    public function getProvinceName()
    {
        if (isset($this->getProvince->name)) {
            return $this->getProvince->name;
        } else {
            return '';
        }
    }

    public function getLevelName()
    {
        if (isset($this->getLevel->name)) {
            return $this->getLevel->name;
        } else {
            return '';
        }
    }

    public function getFullName()
    {
        $first_name = $this->first_name;
        $middle_name = $this->middle_name;
        $last_name = $this->last_name;
        $full_name = $first_name . ' ' . $middle_name . ' ' . $last_name;
        return $full_name;
    }

    public function examRegistrations()
    {
        return $this->hasMany(ExamProcessing::class);
    }
}
