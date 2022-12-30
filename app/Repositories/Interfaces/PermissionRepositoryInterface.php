<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function all();
    public function getById();
    public function store($data);
    public function update($data, $id);
    public function delete($id);
}