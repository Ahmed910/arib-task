<?php

namespace App\Services;

use App\Enums\Pagination;
use App\Models\Employee;
use App\Models\User;

class EmployeeService
{
    public function index()
    {
        return Employee::with('manager')->paginate(Pagination::PAGINATION_COUNT->value);
    }

    public function getEmployees()
    {
        return Employee::get();
    }

    public function getManagers()
    {
        return Employee::whereNull('manager_id')->get();
    }

    public function getManagersWithoutCurrentEditedEmployee(Employee $employee)
    {
        return Employee::whereNull('manager_id')->where('id', '!=', $employee->id)->get();
    }

    public function create(array $data): void
    {
        Employee::create($data);
    }

    public function update(Employee $employee, array $data): void
    {
        $employee->update($data);
    }

    public function delete(Employee $employee): void
    {
        $employee->delete();
    }
}