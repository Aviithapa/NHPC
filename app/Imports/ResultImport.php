<?php

namespace App\Imports;

use App\Models\AdmitCard\ExamResult;
use Maatwebsite\Excel\Concerns\ToModel;

class ResultImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ExamResult([
            'symbol_number'     => $row[0],
            'status'    => $row[1],
            'remarks' => $row[2]
        ]);
    }
}
