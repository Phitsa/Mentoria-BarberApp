<?php

namespace App\Models\Employee;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $table = 'employee_availability';
    protected $fillable = [
        'employee_id',
        'weekday',
        'time',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'time' => 'datetime:H:i',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
