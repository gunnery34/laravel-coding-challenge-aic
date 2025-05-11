<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_name',
        'task_description',
        'date',
        'hours_spent',
        'hourly_rate',
        'additional_charges',
        'total_remuneration'
    ];
}
