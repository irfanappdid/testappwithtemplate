<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "employees_backup";
    protected $primaryKey = "id";

    // public function scopeActive($query)
    // {
    //     return $query->where('status', 'active');
    // }
}