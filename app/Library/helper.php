<?php

use App\Models\Admin\Level;
use App\Models\AdmitCard\AdmitCard;
use App\Models\Certificate\Certificate;
use App\Models\Certificate\CertificateHistory;
use App\Models\Exam\Exam;
use App\Models\Exam\ExamProcessing;
use App\Models\Profile\ProfileProcessing;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Student\Models\Profile;


if (!function_exists('uploadedAsset')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function uploadedAsset($path = null, $file_name = null)
    {
        $path  = Storage::url($path . '/' . $file_name);
        return $path;
    }
}
if (!function_exists('examStudentCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function examStudentCount($level_id)
    {
        $datas = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '=', $level_id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '!=', 'operator')
            ->where('profile_processing.current_state', '!=', 'officer')
            ->count(['profile_processing.profile_id']);

        return $datas;
    }
}

if (!function_exists('examMinuteStudentCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function examMinuteStudentCount($id, $date = null)
    {
        $datas = 0;
        if ($date != null) {
            $datas =  Certificate::join('profile_logs', 'profile_logs.profile_id', '=', 'certificate_history.profile_id')
                ->where('profile_logs.created_by', '=', $id)
                ->where('certificate_history.decision_date', '=', $date)
                ->select('certificate_history.profile_id')
                ->distinct('certificate_history.profile_id')
                ->count(DB::raw('DISTINCT name certificate_history.profile_id'));
        } else {
            $datas =  Certificate::join('profile_logs', 'profile_logs.profile_id', '=', 'certificate_history.profile_id')
                ->where('profile_logs.created_by', '=', $id)
                ->select('certificate_history.profile_id', 'certificate_history.decision_date')
                ->count(['certificate_history.profile_id']);
        }
        return $datas;
    }
}

if (!function_exists('checkStatus')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function checkStatus($program_id, $id)
    {
        $datas = ExamProcessing::all()->where('status', '=', 'progress')
            ->where('state', '=', 'exam_committee')
            ->where('exam_id', '=', $id)
            ->where('is_admit_card_generate', '=', 'yes')
            ->where('program_id', '=', $program_id)
            ->count();

        return $datas;
    }
}


if (!function_exists('getApplicantCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getApplicantCount($status, $state)
    {
        $count = 0;
        $profiles = ExamProcessing::all()->where("status", '=', $status)
            ->where("state", '=', $state);

        return count($profiles);
    }
}


if (!function_exists('getSortSrn')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getSortSrn($sortSrn)
    {
        $arr = explode(",", $sortSrn);
        sort($arr);
        $string = implode(" ", $arr);
        return $string;
    }
}


if (!function_exists('getDoubleDusturCountList')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getDoubleDusturCountList()
    {
        $count = 0;
        $date = "2022-05-05 00:00:00";
        $date_2 = "2022-05-10 00:00:00";
        $exams =  ExamProcessing::all()->where('created_at', '>', $date)
            ->where('created_at', '<', $date_2);

        return count($exams);
    }
}


if (!function_exists('getApplicantProcessingCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getApplicantProcessingCount($status, $state)
    {
        $count = 0;
        $profiles = \App\Models\Profile\ProfileProcessing::all()->where("status", '=', $status)
            ->where("current_state", '=', $state);
        foreach ($profiles as $profile)
            $count++;
        return $count;
    }
}

if (!function_exists('getProgramLicenceCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getProgramLicenceCount($id)
    {
        $count = 0;
        $exam = \App\Models\Exam\ExamProcessing::all()->where("state", '=', 'council');
        foreach ($exam as $ex)
            if ($ex['program_id'] === $id)
                $count++;
        return $count;
    }
}
if (!function_exists('getDartaNumber')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getDartaNumber($id)
    {
        $exam = \App\Models\Certificate\Certificate::all()->where("program_id", '=', $id)->where('decision_date', '=', \date("2022-03-14"))->pluck('srn');
        return $exam;
    }
}

if (!function_exists('getExamApplicantList')) {
    /**
     * Generates an asset path for the uploads.
     * @param $status
     * @param null $state
     * @return string
     */
    function getExamApplicantList($status, $state = null)
    {
        $count = 0;
        $profiles = \App\Models\Exam\ExamProcessing::all()->where("status", '=', $status)
            ->where("state", '=', $state);
        foreach ($profiles as $profile)
            $count++;
        return $count;
    }
}
if (!function_exists('getLevelWiseStudentCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param $status
     * @param null $state
     * @return string
     */
    function getLevelWiseStudentCount($level, $state, $status)
    {
        $profiles = ExamProcessing::all()->where("level_id", '=', $level)
            ->where('state', '=', $state)
            ->where('status', '=', $status);
        return count($profiles);
    }
}

if (!function_exists('getCommitteeWiseStudentCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param $status
     * @param null $state
     * @return string
     */
    function getCommitteeWiseStudentCount($state, $status)
    {
        $subject_Committee_id = \App\Models\SubjectCommittee\SubjectCommitteeUser::all()->where('user_id', '=', Auth::user()->id)->first();

        $profiles = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('profiles.profile_state', $state)
            ->where('profiles.profile_status', $status)
            ->where('program.subject-committee_id', $subject_Committee_id['subjecr_committee_id'])
            ->count();


        return  $profiles;
    }
}

if (!function_exists('getAccepted')) {
    function getAccepted($id)
    {
        $current_user = $this->profileLogsRepository->getAll()->where('created_by', '=', Auth::user()->id)
            ->where('status', 'progress')
            ->where('profile_id', '=', $id);

        return $current_user;
    }
}
if (!function_exists('getLevelWiseStudentCountSubject')) {
    /**
     * Generates an asset path for the uploads.
     * @param $status
     * @param null $state
     * @return string
     */
    function getLevelWiseStudentCountSubject($level, $state, $status)
    {
        $subject_Committee_id = \App\Models\SubjectCommittee\SubjectCommitteeUser::all()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = \App\Models\SubjectCommittee\SubjectCommittee::all()->where('id', '=', $subject_Committee_id['subjecr_committee_id'])->first();
        $count = 0;

        $profiles = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', $state)
            ->where('profiles.level', $level)
            ->where('profile_processing.status', $status)
            ->where('program.subject-committee_id', $subject_Committee_id['subjecr_committee_id'])
            ->orderBy('profiles.created_at', 'ASC')
            ->get(['profiles.*']);


        foreach ($profiles as $data) {
            $log = \App\Models\Profile\Profilelogs::all()->where('profile_id', '=', $data['id'])
                ->where('state', '=', $state)
                ->where('status', '=', $status)
                ->where('created_by', '=', Auth::user()->id)
                ->first();
            if (!$log) {
                $count++;
            }
        }

        return  $count;
    }
}




if (!function_exists('imageNotFound')) {
    /**
     * @param null $type
     * @return string
     */
    function imageNotFound($type = null)
    {
        switch ($type) {
            case 'user':
                return 'https://media.accessiblecms.com.au/uploads/opan/2021/12/200.jpeg';
                break;
            case 'small':
                return 'https://via.placeholder.com/350x150';
                break;
            default:
                return 'dist/img/avatar.png';
                //return asset('images/default.png');

        }
    }
}

if (!function_exists('getProfileImage')) {
    function getProfileImage()
    {
        $data = \Student\Models\Profile::all()->where('user_id', '=', Auth::user()->id)->first();
        if (!$data) {
            return asset('dist/img/avatar.png');
        } else {
            return $data->getProfileImage();
        }
    }
}


if (!function_exists('profileImage')) {
    /**
     * @param null $type
     * @return string
     */
    function profileImage()
    {
        return  \Student\Models\Profile::getProfileImage();
    }
}
if (!function_exists('levelExits')) {
    /**
     * @param null $type
     * @return string
     */
    function levelExits()
    {
        $data = \Student\Models\Profile::all()->where('user_id', '=', Auth::user()->id)->first();
        if ($data != null) {
            if ($data['level'] === 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('getProgramName')) {
    /**
     * @param null $type
     * @return string
     */
    function getProgramName($id)
    {
        $data = \App\Models\Admin\Program::query()->where('id', '=', $id)->first();
        return isset($data['name']) ? $data['name'] : 'Hello';
    }
}

if (!function_exists('getExamName')) {
    /**
     * @param null $type
     * @return string
     */
    function getExamName($id)
    {
        $data = Exam::query()->where('id', '=', $id)->first();
        return isset($data['Exam_name']) ? $data['Exam_name'] : '';
    }
}


if (!function_exists('getLevelName')) {
    /**
     * @param null $type
     * @return string
     */
    function getLevelName($id)
    {
        $data = Level::query()->where('id', '=', $id)->first();
        return isset($data['name']) ? $data['name'] : '';
    }
}

if (!function_exists('admitCard')) {
    /**
     * @param null $type
     * @return string
     */
    function admitCard()
    {
        $data = \Student\Models\Profile::all()->where('user_id', '=', Auth::user()->id)->first();
        if ($data != null) {
            $exam = \App\Models\Exam\ExamProcessing::all()->where('profile_id', '=', $data['id'])->first();
            if ($exam != null) {
                if ($exam['is_admit_card_generate'] === 'no') {
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            return false;
        }
    }
}


if (!function_exists('symbolNumber')) {
    /**
     * @param null $type
     * @return string
     */
    function symbolNumber($id)
    {
        $exam = \App\Models\Exam\ExamProcessing::all()->where('id', '=', $id)->first();
        if ($exam['is_admit_card_generate'] === 'no') {
            return "Not Generated yet";
        } else {
            $admit_card = \App\Models\AdmitCard\AdmitCard::all()->where('exam_processing_id', '=', $id)->first();
            if (!$admit_card)
                return "Not Generated yet";
            return $admit_card['symbol_number'];
        }
    }
}


if (!function_exists('countAdmitCard')) {
    /**
     * @param null $type
     * @return string
     */
    function countAdmitCard()
    {
        $count = 0;
        $exams = \App\Models\Exam\ExamProcessing::all()->where('state', '=', 'exam_committee')
            ->where('status', '=', 'progress');
        foreach ($exams as $exam) {
            if ($exam['is_admit_card_generate'] === 'no') {
                $count = ++$count;
            }
        }
        return $count;
    }
}

if (!function_exists('countAdmitGeneratedCard')) {
    /**
     * @param null $type
     * @return string
     */
    function countAdmitGeneratedCard()
    {
        $count = 0;
        $exams = \App\Models\Exam\ExamProcessing::all()->where('state', '=', 'exam_committee')
            ->where('status', '=', 'progress');
        foreach ($exams as $exam) {
            if ($exam['is_admit_card_generate'] === 'yes') {
                $count = ++$count;
            }
        }
        return $count;
    }
}


/**
 * Created by PhpStorm.
 * User: Saurav KC
 * Date: 2/14/2018
 * Time: 2:17 PM
 */


if (!function_exists('pagination_links')) {

    /**
     * @param $data
     * @param null $view
     *
     * @return mixed
     */
    function pagination_links($data, $view = null)
    {
        if ($query = Request::query()) {
            $request = array_except($query, 'page');

            return $data->appends($request)->render($view);
        }

        return $data->render($view);
    }
}


if (!function_exists('getPermissionList')) {
    function getPermissionList()
    {
        $permission_lists = [];
        $permissions = \App\Models\Auth\Permission::latest()->pluck('name', 'id');
        foreach ($permissions as $key => $value) {
            if ($pos = strpos($value, '-')) {
                $key_one = substr($value, 0, $pos);
                $permission_lists[$key_one][$key] = $value;
            } else {
                $permission_lists[$key] = $value . '1';
            }
        }
        return $permission_lists;
    }
}

if (!function_exists('pluckRoleList')) {
    /**
     * Pluck role ID and Name in Array
     * @return mixed
     */
    function pluckRoleList()
    {
        return \App\Models\Auth\Role::pluck('name', 'id');
    }
}


if (!function_exists('optionsToArray')) {
    function optionsToArray($options, $id = 'id')
    {
        $array = [];
        foreach ($options as $option) {
            $array[] = $option->$id;
        }
        return $array;
    }
}

if (!function_exists('getStatusList')) {
    function getStatusList()
    {
        $status = [
            'draft' => 'Draft',
            'hidden' => 'Hidden',
            'published' => 'Published',
            'spam' => 'Spam',
            'suspended' => 'Suspended'
        ];
        return $status;
    }
}


if (!function_exists('getSettingValue')) {
    /**
     * Gets setting value
     *
     * @param $key
     * @return string
     */
    function getSettingValue($key)
    {
        return null;
        /*$service = app(App\Modules\Saurav\Setting\Repositories\SettingRepository::class);
        return $service->getValue($key);*/
    }
}

if (!function_exists('getSettingValueAsArray')) {
    /**
     * Gets setting value
     *
     * @param $key
     * @return array
     */
    function getSettingValueAsArray($key)
    {
        return [];
        /*$service = app(App\Modules\Saurav\Setting\Repositories\SettingRepository::class);
        return $service->getValueAsArray($key);*/
    }
}



if (!function_exists('getSiteSetting')) {
    /**
     * @param $name
     * @return null
     */
    function getSiteSetting($name)
    {
        if ($name === 'logo_image') {
            return App\Models\Website\SiteSetting::getLogoImage($name);
        }

        return App\Models\Website\SiteSetting::getValue($name);
    }
}





if (!function_exists('checkForPermission')) {
    /**
     * @param $permission_name
     * @return bool
     */
    function checkForPermission($permission_name)
    {
        $user = Auth::User();
        if (Auth::check() && ($user->isSuperAdmin() || $user->can($permission_name))) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('uploadedAsset')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function uploadedAsset($path = null, $file_name = null)
    {
        $path = Storage::url($path . '/' . $file_name);
        return $path;
    }
}


if (!function_exists('imageNotFound')) {
    /**
     * @param null $type
     * @return string
     */
    function imageNotFound($type = null)
    {
        switch ($type) {
            case 'user':
                return '/assets/img/profiles/avatar.jpg';
                break;
            case 'small':
                return 'https://via.placeholder.com/350x150';
                break;
            default:
                return 'https://via.placeholder.com/350x150';
                //return asset('images/default.png');

        }
    }
}





if (!function_exists('getDateFormat')) {
    function getDateFormat($date = null)
    {
        if (is_null($date)) {
            $date = now();
        }
        return date('jS M, Y', strtotime($date));
    }
}

if (!function_exists('getActiveInactiveStatus')) {
    function getActiveInactiveStatus()
    {
        return ['active' => 'Active', 'in-active' => 'In Active'];
    }
}


if (!function_exists('getUniversityCategory')) {
    function getUniversityCategory()
    {
        return [
            'TU' => 'Tribhuvan University ',
            'PU' => 'Pokhara University',
            'PBU' => 'Purbanchal University',
            'NEB' => "Nation Examination Board",
            'other' => 'Other'
        ];
    }
}
if (!function_exists('getPublicationCategory')) {
    function getPublicationCategory()
    {
        return [
            'null' => '--SELECT-- ',
            'asmita' => 'Asmita Publication',
            'saraswati' => 'Saraswati Publication',
            'samiksya ' => 'Samiksya Publication',
            'mk_publication' => "MK Publication",
            'kriti' => "Kriti Publication",
            'khanal' => "Khanal Publication",
            'shiva' => "Shivva Publication",
            'sanjana' => "Sanjana Publication",
            'goodwill' => "GoodWill Publication",
            'Buddha' => "Buddha Publication",
            'other' => "Other"
        ];
    }
}
if (!function_exists('getYear')) {
    function getYear()
    {
        return [
            'null' => '--SELECT-- ',
            '1_year' => "1st Year",
            '2_year' => "2nd Year",
            '3_year' => "3rd Year",
            '4_year' => "4th Year",
        ];
    }
}
if (!function_exists('getSubCategory')) {
    function getSubCategory()
    {
        return [
            'coursebook' => 'Coursebook',
            'novel' => 'Novel',
            'nepali_novel' => "Nepali Novel",
            'Rakshya' => 'Book Pack',
            'question-bank-and-solution' => 'Question bank and Solution',
            'loksewa-examination' => 'Loksewa Examination',
            'entrance-examination' => 'Entrance Examination',
            'medical-examination' => 'Medical Examination',
        ];
    }
}


if (!function_exists('getCountryList')) {
    function getCountryList()
    {
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        foreach ($countries as $country) {
            $new_array[$country] = $country;
        }
        return $new_array;
    }
}
if (!function_exists('getSchoolType')) {
    function getSchoolType()
    {
        $schoolTypes = array("Public", "Private", "Government");
        foreach ($schoolTypes as $school) {
            $new_array[$school] = $school;
        }
        return $new_array;
    }
}

if (!function_exists('generateSlug')) {
    /**
     * Generates the alias equivalent for the provided string
     *
     * @param $string
     * @return mixed|string
     */
    function generateSlug($string)
    {
        $string = strtolower($string);
        $string = str_replace(" ", "-", $string);
        $string = str_replace(".", "-", $string);
        $string = str_replace("--", "-", $string);
        $string = str_replace("--", "-", $string);
        $string = str_replace("--", "-", $string);
        $string = str_replace("&", "and", $string);
        $string = str_replace("@", "", $string);
        $string = str_replace("(", "", $string);
        $string = str_replace(")", "", $string);
        $string = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);
        return $string;
    }
}


if (!function_exists('getSliderType')) {
    function getSliderType()
    {
        $array = [
            'image' => 'Image', 'video' => 'Video'
        ];
        return $array;
    }
}



if (!function_exists('getSalutation')) {
    function getSalutation()
    {
        return ['Mr.' => 'Mr.', 'Ms.' => 'Ms.', 'Mrs.' => 'Mrs.', 'Mx.' => 'Mx.', 'Sir' => 'Sir', 'Madam' => 'Madam'];
    }
}
if (!function_exists('removeKeyFromArray')) {
    function removeKeyFromArray($array, $removeKeys)
    {
        foreach ($removeKeys as $removeKey)
            //        dd($array[$removeKey]);
            unset($array[$removeKey]);
        return $array;
    }
}


if (!function_exists('getApplliedStudent')) {
    function getApplliedStudent($id)
    {
        $count = 0;
        $student = \App\Models\Exam\ExamProcessing::all()->where("program_id", '=', $id);
        foreach ($student as $student_count)
            $count++;
        return $count;
    }
}

if (!function_exists('getTotalApplication')) {
    function getTotalApplication()
    {
        $count = 0;
        $student = \Student\Models\Profile::all();
        foreach ($student as $student_count)
            $count++;
        return $count;
    }
}
if (!function_exists('getVerifiedStudent')) {
    function getVerifiedStudent($state, $status)
    {
        $count = 0;
        $student = \Student\Models\Profile::all()->where('profile_state', '=', $state)->where('profile_status', '=', $status);
        foreach ($student as $student_count)
            $count++;
        return $count;
    }
}
if (!function_exists('getprofileVerifiedStudent')) {
    function getprofileVerifiedStudent($state, $status)
    {
        $count = 0;
        $student = \App\Models\Profile\ProfileProcessing::all()->where('current_state', '=', $state)->where('status', '=', $status);
        foreach ($student as $student_count)
            $count++;
        return $count;
    }
}

if (!function_exists('getProgramNameForProfile')) {
    function getProgramNameForProfile($id)
    {

        $program_id = \App\Models\Exam\ExamProcessing::all()->where('profile_id', '=', $id)->first();
        if ($program_id == null)
            return '';
        $program = \App\Models\Admin\Program::all()->where('id', '=', $program_id['program_id'])->first();

        return $program['name'];
    }
}

if (!function_exists('getProgramNameForProfileLevel')) {
    function getProgramNameForProfileLevel($id)
    {

        $program_id = \App\Models\Exam\ExamProcessing::all()->where('profile_id', '=', $id)->first();
        if ($program_id == null)
            return '';
        $program = \App\Models\Admin\Program::all()->where('id', '=', $program_id['program_id'])->first();
        return $program['level_id'];
    }
}


if (!function_exists('getSymbolNo')) {
    function getSymbolNo($exam_id)
    {

        $symbolNumber = AdmitCard::all()->where('exam_processing_id', '=', $exam_id)->first();
        if ($symbolNumber === null)
            return 'Not Generated Yet';
        return $symbolNumber['symbol_number'];
    }
}

if (!function_exists('getExamStatus')) {
    function getExamStatus($exam_id)
    {

        $exam = ExamProcessing::all()->where('id', '=', $exam_id)->first();
        if ($exam['isPassed'] == 0 && $exam['is_admit_card_generate'] == 'yes' && $exam['exam_id'] != 7)
            return 'Failed';
        elseif ($exam['exam_id'] == 3 || $exam['exam_id'] == 4 || $exam['exam_id'] == 5 || $exam['exam_id'] == 6 && $exam['status'] == 'rejected')
            return 'Failed';
        elseif ($exam['isPassed'] == 0 && $exam['attempt'] == '2')
            return 'Re Exam';
        elseif ($exam['status'] == 'progress' && $exam['state'] == 'exam_committee' && $exam['exam_id'] == 7)
            return 'Re Exam';
        else
            return 'New Applied';
    }
}

if (!function_exists('examStats')) {
    function getExamStats($profile_id)
    {
        $exam = ExamProcessing::all()->where('profile_id', '=', $profile_id)->where('isPassed', '=', '0')->where('attempt', '=', 2)->first();
        if ($exam === null)
            return;
        return $exam;
    }
}


if (!function_exists('getHighteshQualification')) {
    function getHighteshQualification($qualification)
    {
        if ($qualification == 0) {
            return [
                '1' => 'SLC',
                '2' => 'TSLC',
                '3' => 'PCL',
                '4' => 'Bachelor',
                '5' => 'Master',
            ];
        } else if ($qualification == 1) {
            return [
                '1' => 'SLC',
                '2' => 'TSLC',
                '3' => 'PCL',
                '4' => 'Bachelor',
                '5' => 'Master',
            ];
        } else if ($qualification == 2) {
            return [
                '1' => 'SLC',
                '2' => 'TSLC',
                '3' => 'PCL',
                '4' => 'Bachelor',
                '5' => 'Master',
            ];
        } else if ($qualification == 3) {
            return [
                '1' => 'SLC',
                '2' => 'TSLC',
                '3' => 'PCL',
                '4' => 'Bachelor',
                '5' => 'Master',
            ];
        } else if ($qualification == 4) {
            return [
                '1' => 'SLC',
                '2' => 'TSLC',
                '3' => 'PCL',
                '4' => 'Bachelor',
                '5' => 'Master',
            ];
        } else if ($qualification == 4) {
            return [
                '1' => 'SLC',
                '2' => 'TSLC',
                '3' => 'PCL',
                '4' => 'Bachelor',
                '5' => 'Master',
            ];
        } else {
            return [
                '1' => 'SLC',
                '2' => 'TSLC',
                '3' => 'PCL',
                '4' => 'Bachelor',
                '5' => 'Master',
            ];
        }
    }
}


if (!function_exists('getExamCommitteeCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getExamCommitteeCount($id)
    {

        $profiles = ExamProcessing::all()->where("status", '=', 'progress')
            ->where("state", '=', 'exam_committee')
            ->where("exam_id", '=', $id)->count();

        return $profiles;
    }
}

if (!function_exists('idCard')) {
    function idCard()
    {
        $profile = Profile::all()->where('user_id', '=', Auth::user()->id)->first();

        if (isset($profile)) {
            $data = Certificate::where('certificate_history.profile_id', '=', $profile->id)
                ->get()->first();
            if ($data) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}


if (!function_exists('getExamName')) {
    function getExamName($id)
    {
        $profile = Exam::all()->where('id', '=', $id)->first();

        if (isset($profile)) {

            return $profile['Exam_name'];
        } else {
            return $id;
        }
    }
}
