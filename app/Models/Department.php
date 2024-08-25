<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $appended = ['employees_salary_for_each_department'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    protected function employeesSalaryForEachDepartment(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->employees()->sum('salary'),
        );
    }
}
