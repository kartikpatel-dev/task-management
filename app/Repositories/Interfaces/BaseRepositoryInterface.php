<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all();
    public function getById($id);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
}
