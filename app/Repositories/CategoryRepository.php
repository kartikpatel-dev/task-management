<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    private $_title = 'Category';

    public function all()
    {
        return Category::with(['parent'])->paginate();
    }

    public function getById($id)
    {
        return Category::findOrFail($id);
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

        if (!empty($RS_Row->image)) {
            Category::mediaDelete($RS_Row->image);
        }

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
        $RS_Row = empty($id) ? new Category() : $this->getById($id);

        $RS_Row->name = $data->name;
        $RS_Row->slug = Str::slug($data->slug, '-');
        $RS_Row->parent_id = !empty($data->parent_id) ? $data->parent_id : NULL;
        $RS_Row->user_id = auth()->user()->id;
        $RS_Row->description = $data->description;
        $RS_Row->status = $data->status;
        $RS_Row->type = $data->type;

        if ($data->has('image')) {
            $fileName = Category::mediaUpload($data->file('image'), $RS_Row->image);

            $RS_Row->image = $fileName;
        }

        $RS_Row->save();

        return $RS_Row;
    }
}
