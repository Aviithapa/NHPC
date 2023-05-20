<?php

namespace App\Imports;

use App\Models\Certificate\Certificate;
use App\Models\Certificate\CertificateHistory;
use App\Models\Certificate\CertificateHistoryData;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class OldFileImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // return new CertificateHistoryData([
        //     'profile_id' => $row[0],
        //     'profile_picture' => $row[1],
        //     'municipality' => $row[2],
        //     'email' => $row[3],
        //     'phone_number'     => $row[4],
        //     'qualification' => $row[5]
        //     // certificate	type	remarks	is_printed	printed_date	printed_by	is_edited	issued_by	decision_date	certificate_status
        // ]);

        // return new Certificate([
        //     'id' => $row[0],
        //     'registration_id' => $row[1],
        //     'category_id' => $row[2],
        //     'program_id' => $row[3],
        //     'program_certificate_code' => $row[4],
        //     'srn'     => $row[5],
        //     'cert_registration_number' => $row[6],
        //     'registrar' => $row[7],
        //     'decision_date' => $row[8],
        //     'name'     => $row[9],
        //     'date_of_birth'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(((int) $row[10])),
        //     'address' => $row[11],
        //     'program_name'    => $row[12],
        //     'level_name'    => $row[13],
        //     'qualification' => $row[14],
        //     'issued_year' => $row[15],
        //     'issued_date' => $row[16],
        //     'valid_till' => $row[17],
        //     'certificate' => $row[18],
        //     'type' => $row[19],
        //     'remarks' => $row[20],
        //     'is_printed' => $row[21],
        //     'printed_date' => $row[22],
        //     'printed_by' => $row[23],
        //     'is_edited' => $row[24],
        //     'time_stamp' => $row[25],
        //     'issued_by' => $row[26],
        //     'certificate_status' => $row[27],
        //     'profile_id' => $row[28],
        //     'created_at' => $row[29],
        //     'updated_at' => $row[30],
        //     // certificate	type	remarks	is_printed	printed_date	printed_by	is_edited	issued_by	decision_date	certificate_status
        // ]);
        return new Certificate([
            'profile_photo' => $row[26],
            'name'     => $row[0],
            'date_of_birth'    => $row[1],
            'program_code' => $row[2],
            'srn'     => $row[3],
            'ward'    => $row[4],
            'municipality' => $row[5],
            'district' => $row[6],
            'province' => $row[7],
            'level' => $row[8],
            'registration_number' => $row[9],
            'date_of_issue' => $row[10],
            'qualification' => $row[11],
            'insitutate' => $row[12],
            'passed_year' => $row[13],
            'registrar' => $row[14],
            'valid_till' => $row[15],
            'certificates' => $row[16],
            'type' => $row[17],
            'remark' => $row[18],
            'is_printed' => $row[19],
            'printed_date' => $row[20],
            'printed_by' => $row[21],
            'is_edited' => $row[22],
            'issued_by' => $row[23],
            'decision_date' => $row[24],
            'certificate_status' => $row[25]
            // certificate	type	remarks	is_printed	printed_date	printed_by	is_edited	issued_by	decision_date	certificate_status

        ]);
    }
}
