<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all()
    {
        return Permission::all();
    }

    public function getById()
    {
        return Permission::first();
    }

    public function store($data)
    {
        return $data;
    }

    public function update($data, $id)
    {
        return $id;
    }

    public function delete($id)
    {
        return $id;
    }

    public function changeStatus()
    {
        return 'change status';
    }
}
