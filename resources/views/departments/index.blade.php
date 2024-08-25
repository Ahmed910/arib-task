<!-- resources/views/departments/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Departments
                        <a href="{{ route('departments.create') }}" class="btn btn-primary">Create department</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                     @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                 <td>Employees Count</td>
                                 <td>Employees Salary(Sum)</td>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->employees_count }}</td>
                                    <td>{{ $department->employees_salary_for_each_department }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('departments.edit', $department) }}" class="btn btn-secondary btn-sm">Edit</a>
                                            <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this department?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $departments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection