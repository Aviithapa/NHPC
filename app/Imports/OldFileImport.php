<?php

namespace App\Imports;

use App\Models\Certificate\CertificateHistory;
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
        return new CertificateHistory([
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
