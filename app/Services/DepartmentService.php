<?php

namespace App\Services;

use App\Enums\Pagination;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Arr;

class DepartmentService
{
    public function index()
    {
        return Department::withCount('employees')->paginate(Pagination::PAGINATION_COUNT->value);
    }

    public function getDepartments()
    {
        return Department::get();
    }

    public function create($data)
    {
        $department = Department::create(Arr::only($data, 'name'));
    }

    public function update(Department $department, array $data)
    {
        $department->update(Arr::only($data, 'name'));

    }

    public function delete(Department $department)
    {
        if ($department->employees()->count() > 0) {
            return false;
        }

        $department->delete();

    }
}