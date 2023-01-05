<?php

namespace App\Repositories;

use App\Models\ProjectIssue;
use App\Repositories\Interfaces\ProjectIssueRepositoryInterface;

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
        $RS_Row_ProIssue = $this->_StoreUpdate($data);

        if (!empty($RS_Row_ProIssue)) :
            return array(
                'messageType' => 'success',
                'message' => "{$this->_title} creaded successfully.",
                'data' => view('projects.issue_item', compact('RS_Row_ProIssue'))->render()
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
            ->orderByRaw('LENGTH(slug) DESC, slug DESC')
            ->first();
    }

    public function getLastMenuOrder($project_id)
    {
        return ProjectIssue::where('project_id', $project_id)
            ->latest('menu_order')
            ->first();
    }

    public function changeStatus($data)
    {
        $RS_Row = $this->getById($data->project_issue_id)
            ->update(['status_id' => $data->status_id]);

        if (!empty($RS_Row)) {
            return array(
                'messageType' => 'success',
                'message' => 'Successfully'
            );
        } else {
            return array(
                'messageType' => 'error',
                'message' => 'Error'
            );
        }
    }

    public function changeMenuOrder($data)
    {
        // return $data->all();
        $RS_Row_2 = $this->getById($data->project_issue_id_2)
            ->update(['menu_order' => $data->ps_menu_order_1]);

        $RS_Row_1 = $this->getById($data->project_issue_id_1)
            ->update(['menu_order' => $data->ps_menu_order_2]);

        if (!empty($RS_Row_1) && !empty($RS_Row_2)) {
            return array(
                'messageType' => 'success',
                'message' => 'Successfully'
            );
        } else {
            return array(
                'messageType' => 'error',
                'message' => 'Error'
            );
        }
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

        $lastMenuOrder = $this->getLastMenuOrder($data->project_id);
        $RS_Row->menu_order = empty($lastMenuOrder->menu_order) ? 1 : $lastMenuOrder->menu_order + 1;

        $RS_Row->save();

        return $RS_Row;
    }
}
