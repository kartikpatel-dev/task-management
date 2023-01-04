<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use Illuminate\Support\Str;

class StatusRepository implements StatusRepositoryInterface
{
    private $_title = 'Status';

    public function all()
    {
        return Status::latest('menu_order')->paginate();
    }

    public function getById($id)
    {
        return Status::findOrFail($id);
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

    private function _StoreUpdate($data, $id = 0)
    {
        $RS_Row = empty($id) ? new Status() : $this->getById($id);

        $RS_Row->name = $data->name;

        $RS_Row->users()
            ->sync([auth()->user()->id]);

        $RS_Row->save();

        return $RS_Row;
    }
}
