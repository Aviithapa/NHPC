<?php

namespace App\Exports;

use App\Models\AdmitCard\ExamResult;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResultExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ExamResult::all();
    }
}
