<?php


namespace App\Modules\Backend\Admin\Level\Repositories;


use App\Modules\Framework\Repository;

interface LevelRepository extends  Repository
{
    /**Gets all data for data-table
     * @return mixed
     */
    public function getAllRecruitersForDataTable();

}
