<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(private readonly EmployeeService $employeeService, private readonly DepartmentService $departmentService)
    {
        
    }

    public function index()
    {
        $departments = $this->departmentService->index();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $employees = $this->employeeService->getEmployees();

        return view('departments.create', compact('employees'));
    }

    public function store(CreateDepartmentRequest $request)
    {
        $this->departmentService->create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        $employees = $this->employeeService->getEmployees();

        return view('departments.edit', compact('department', 'employees'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {

        $this->departmentService->update($department, $request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $isDeleted = $this->departmentService->delete($department);

        if (!$isDeleted)  {
            return redirect()->route('departments.index')
            ->with('error', 'Couldn\'t delete department which has employees.');
        }
        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
