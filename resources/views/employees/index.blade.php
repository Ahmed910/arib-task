<!-- resources/views/employees/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Employees
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">Create Employee</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Salary</th>
                                <th>Manager</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        @if ($employee->image)
                                            <img src="{{ asset('storage/images/employees/' . $employee->image) }}" alt="{{ $employee->full_name }}" class="img-thumbnail" style="max-width: 50px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ number_format($employee->salary, 2) }}</td>
                                    <td>{{ $employee->manager ? $employee->manager->first_name . ' ' . $employee->manager->last_name : 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-secondary btn-sm">Edit</a>
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection