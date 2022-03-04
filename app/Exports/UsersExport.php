<?php

namespace App\Exports;

use App\Models\Exam\ExamProcessing;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements  WithHeadings, WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
//
//    public function collection()
//    {
//        $tasks = ExamProcessing::all()->where('status', '=', 'progress')
//            ->where('state', '=', 'exam_committee')
//            ->where('is_admit_card_generate', '=' ,'yes');
//        foreach ($tasks as $task) {
//            $row['First Name'] = $task->getFirstName();
//            $row['Middle Name'] = $task->getMiddleName();
//            $row['Last Name'] = $task->getLastName();
//            $row['Symbol Number'] ="";
//            $row['Gender'] = $task->getGender();
//            $row['Program'] = $task->getProgramName();
//            $row['Level'] = $task->getLevelName();
//        }
//
//
//    }

    /**
     * @inheritDoc/
     */
    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Symbol Number',
            'Gender',
            'Program Name',
            'Level'
        ];
    }

    /**
     * @inheritDoc
     */
    public function map($tasks): array
    {
        $tasks = ExamProcessing::all()->where('status', '=', 'progress')
            ->where('state', '=', 'exam_committee')
            ->where('is_admit_card_generate', '=' ,'yes');
        return [
            $tasks->getFirstName(),
            $tasks->getMiddleName(),
            $tasks->getLastName(),
            "",
             $tasks->getGender(),
            $tasks->getProgramName(),
             $tasks->getLevelName(),
    ];

    }
}
