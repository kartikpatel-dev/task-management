<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface ProjectIssueRepositoryInterface extends BaseRepositoryInterface
{
    public function changeStatus($data);
    public function changeMenuOrder($data);
}
