<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Str;

class RoleRepository implements RoleRepositoryInterface
{
    private $_title = 'Role';

    public function all()
    {
        return Role::paginate();
    }

    public function getById($id)
    {
        return Role::findOrFail($id);
    }

    public function store($data)
    {
        $RS_Row = $this->_StoreUpdate($data);

        if (!empty($RS_Row)) :
            return array(
                'messageType' => 'success',
                'message' => "{$this->_title} creaded successfully.",
                'data' => $RS_Row
            );
        else :
            return array(
                'messageType' => 'error',
                'message' => "Can't create {$this->_title}, try after sometime.",
                'data' => NULL
            );
        endif;
    }

    public function update($data, $id)
    {
        $RS_Row = $this->_StoreUpdate($data, $id);

        if (!empty($RS_Row)) :
            return array(
                'messageType' => 'success',
                'message' => "{$this->_title} updated successfully.",
                'data' => $RS_Row
            );
        else :
            return array(
                'messageType' => 'error',
                'message' => "Can\'t update {$this->_title}, try after sometime.",
                'data' => NULL
            );
        endif;
    }

    public function delete($id)
    {
        $RS_Row = $this->getByID($id);

        if (!empty($RS_Row) && $RS_Row->slug == 'admin') {
            return array(
                'messageType' => 'info',
                'message' => "Admin {$this->_title} can't delete",
                'data' => NULL
            );
        } else {
            $RS_Row->delete($id);

            if (!empty($RS_Row)) {
                return array(
                    'messageType' => 'success',
                    'message' => "{$this->_title} deleted successfully!",
                    'data' => $id
                );
            } else {
                return array(
                    'messageType' => 'error',
                    'message' => "{$this->_title} not delete, please try again later",
                    'data' => NULL
                );
            }
        }
    }

    private function _StoreUpdate($data, $id = 0)
    {
        $RS_Row = empty($id) ? new Role() : $this->getById($id);

        $RS_Row->name = $data->name;
        if (empty($id)) {
            $RS_Row->slug = Str::slug($data->name, '-');
        }

        $RS_Row->save();

        return $RS_Row;
    }
}
