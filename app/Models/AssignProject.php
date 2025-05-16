<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProject extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "assign_project";
    protected $primaryKey = "assign_project_id";

    // public function scopeActive($query)
    // {
    //     return $query->where('status', 'active');
    // }

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id', 'id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}