<?php


namespace Student\Models;


use App\Models\Admin\Level;
use App\Models\Admin\Program;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Qualification extends Model
{
    protected $table="registrant_qualification";

    protected $fillable = [
        'name', 'board_university', 'passed_year','admission_year','program_id','collage_name','user_id','level','registration_number',
        'transcript_image','provisional_image','character_image','ojt_image','intership_image','visa_image','noc_image','passport_image',
        'licence','ojt_pcl_community_1_image','ojt_pcl_community_2_image','transcript_mas_marksheet','transcript_bac_3','transcript_bac_2'
        ,'transcript_bac_1'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLevel(){
        return $this->hasOne(Level::class,'level_number','level');
    }

    public function getLevelName(){
        if(isset($this->getLevel->name)) {
            return $this->getLevel->name;
        }
        else {
            return "";
        }
    }


    public function getProgram(){
        return $this->hasOne(Program::class,'id','program_id');
    }

    public function getProgramName(){
        if(isset($this->getProgram->name)) {
            return $this->getProgram->name;
        }
        else {
            return "";
        }
    }
    public function getTranscriptImage()
    {
        return Storage::url('documents/' .$this->transcript_image);
    }
    public function getProvisionalImage()
    {
        return Storage::url('documents/' .$this->provisional_image);
    }
    public function getCharacterImage()
    {
        return Storage::url('documents/' .$this->character_image);
    }

    public function getOJTImage()
    {
        return Storage::url('documents/' .$this->ojt_image);
    }

    public function getIntershipImage()
    {
        return Storage::url('documents/' .$this->intership_image);
    }
    public function getNocImage()
    {
        return Storage::url('documents/' .$this->noc_image);
    }
    public function getVisaImage()
    {
        return Storage::url('documents/' .$this->visa_image);
    }
    public function getPassportImage()
    {
        return Storage::url('documents/' .$this->passport_image);
    }


    public function getOjt1Image()
    {
        if(isset($this->ojt_pcl_community_1_image)) {
            return Storage::url('documents/' .$this->ojt_pcl_community_1_image);
        }
        else {
            return imageNotFound();
        }
    }

    public function getOjt2Image()
    {
        if(isset($this->ojt_pcl_community_2_image)) {
            return Storage::url('documents/' .$this->ojt_pcl_community_2_image);
        }
        else {
            return imageNotFound();
        }
    }

    public function getMasMarksheetImage()
    {
        if(isset($this->transcript_mas_marksheet)) {
            return Storage::url('documents/' .$this->transcript_mas_marksheet);
        }
        else {
            return imageNotFound();
        }
    }

    public function getTranscript1Image()
    {
        if(isset($this->transcript_bac_1)) {
            return Storage::url('documents/' .$this->transcript_bac_1);
        }
        else {
            return imageNotFound();
        }
    }

    public function getTranscript2Image()
    {
        if(isset($this->transcript_bac_2)) {
            return Storage::url('documents/' .$this->transcript_bac_2);
        }
        else {
            return imageNotFound();
        }
    }

    public function getTranscript3Image()
    {
        if(isset($this->transcript_bac_3)) {
            return Storage::url('documents/' .$this->transcript_bac_3);
        }
        else {
            return imageNotFound();
        }
    }
}
