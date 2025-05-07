@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Students</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Student
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Blood Group</th>
                        <th>Nationality</th>
                        <th>Religion</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->user->email }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->date_of_birth }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->blood_group }}</td>
                        <td>{{ $student->nationality }}</td>
                        <td>{{ $student->religion }}</td>
                        <td>
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
