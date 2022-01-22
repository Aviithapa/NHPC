<?php

namespace App\Modules\Backend\Admin\Category\Repositories;

use App\Modules\Framework\Repository;

interface CategoryRepository extends  Repository
{
    /**Gets all data for data-table
     * @return mixed
     */
    public function getAllRecruitersForDataTable();

}

