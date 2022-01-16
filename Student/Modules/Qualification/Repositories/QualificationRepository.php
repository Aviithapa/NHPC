<?php


namespace Student\Modules\Qualification\Repositories;


use Student\Modules\Framework\Repository;

interface QualificationRepository extends Repository
{
    public function masterData($id);
    public function bachelorData($id);
    public function pclData($id);
    public function slcData($id);
}
