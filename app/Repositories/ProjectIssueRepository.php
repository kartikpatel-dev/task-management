<?php

namespace App\Repositories;

use App\Models\ProjectIssue;
use App\Repositories\Interfaces\ProjectIssueRepositoryInterface;
use Illuminate\Support\Str;

class ProjectIssueRepository implements ProjectIssueRepositoryInterface
{
    private $_title = 'Project Issue';

    public function all()
    {
        return ProjectIssue::latest('menu_order')->paginate();
    }

    public function getById($id)
    {
        return ProjectIssue::findOrFail($id);
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

    public function getLastProjectIssue($project_id)
    {
        return ProjectIssue::where('project_id', $project_id)
            ->latest('slug')
            ->first();
    }

    private function _StoreUpdate($data, $id = 0)
    {
        $RS_Row = empty($id) ? new ProjectIssue() : $this->getById($id);

        $RS_Row->user_id = auth()->user()->id;
        $RS_Row->project_id = $data->project_id;
        $RS_Row->status_id = $data->status_id;
        $RS_Row->title = $data->issue_title;

        $lastSlug = $this->getLastProjectIssue($data->project_id);
        $lastSlugIndex = !empty($lastSlug) ? substr($lastSlug->slug, strrpos($lastSlug->slug, '-') + 1) + 1 : 1;
        $RS_Row->slug = $data->project_slug . '-' . $lastSlugIndex;

        $RS_Row->save();

        return $RS_Row;
    }
}
