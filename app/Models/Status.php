<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'menu_order',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_status');
    }

    public function projectIssues()
    {
        return $this->hasMany(ProjectIssue::class)->latest('menu_order');
    }
}
