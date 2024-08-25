<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(private readonly EmployeeService $employeeService, private readonly DepartmentService $departmentService) {}

    public function index()
    {
        $employees = $this->employeeService->index();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $managers = $this->employeeService->getManagers();

        $departments = $this->departmentService->getDepartments();

        return view('employees.create', compact('managers', 'departments'));
    }

    public function store(CreateEmployeeRequest $request)
    {
        $this->employeeService->create($request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $departments = $this->departmentService->getDepartments();

        $managers = $this->employeeService->getManagersWithoutCurrentEditedEmployee($employee);

        return view('employees.edit', compact('employee', 'managers', 'departments'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {

        $this->employeeService->update($employee, $request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $this->employeeService->delete($employee);

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
