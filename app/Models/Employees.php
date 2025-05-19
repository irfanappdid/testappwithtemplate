<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employees extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = 'employee';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];
    protected $table = "employees_backup";
    protected $primaryKey = "id";

    // public function scopeActive($query)
    // {
    //     return $query->where('status', 'active');
    // }
}
