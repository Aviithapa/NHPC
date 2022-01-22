<?php


namespace App\Modules\Backend\Admin\Program\Repositories;


use App\Modules\Framework\Repository;

interface ProgramRepository  extends  Repository
{
    /**Gets all data for data-table
     * @return mixed
     */
    public function getAllRecruitersForDataTable();

}
