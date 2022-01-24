<?php


namespace App\Models\officer;


use Illuminate\Database\Eloquent\Model;

class RegistrationProcessing extends Model
{
    protected $table ="registration_processing";
    protected $fillable=['registration_id','darta_number','registration_type',
        'comment','current_state','current_status','status','created_by','review_status',
        'sub_delete','created_date','approval_subject','approval_exam','approval_council','approval_levels',
        'check_state','subject_committee_minute','routing_number','subject_committee_accepted_date','council_accepted_date',
        'exam_committee_minute','council_minute','re_exam','re_exam_attempts','re_exam_voucher_accept','re_exam_voucher_image',
        'voucher_uploaded'
        ];
}
