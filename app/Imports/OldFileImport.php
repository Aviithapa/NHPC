<?php

namespace App\Imports;

use App\Models\Certificate\CertificateHistory;
use Maatwebsite\Excel\Concerns\ToModel;

// class OldFileImport implements ToModel
// {
//     /**
//      * @param array $row
//      *
//      * @return \Illuminate\Database\Eloquent\Model|null
//      */
//     public function model(array $row)
//     {
//         return new CertificateHistory([
//             'name'     => $row[0],
//             'date_of_birth'    => $row[1],
//             'program_code' => $row[2],
//             'srn'     => $row[0],
//             'ward'    => $row[1],
//             'municipality' => $row[2],
//             'district' => $row[],
//             'province' => $row[],
//             'level' => $row[],
//             'registration_number' => $row[],
//             'date_of_issue' => $row[],
//         ]);
//     }
// }
