@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Student Details</h2>
    <div>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i> Delete
            </button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Basic Information</h4>
                <div class="mb-3">
                    <strong>Full Name:</strong> {{ $student->full_name }}
                </div>
                <div class="mb-3">
                    <strong>Email:</strong> {{ $student->email }}
                </div>
                <div class="mb-3">
                    <strong>Phone:</strong> {{ $student->phone }}
                </div>
                <div class="mb-3">
                    <strong>Date of Birth:</strong> {{ $student->date_of_birth }}
                </div>
                <div class="mb-3">
                    <strong>Gender:</strong> {{ $student->gender }}
                </div>
            </div>
            <div class="col-md-6">
                <h4>Additional Information</h4>
                <div class="mb-3">
                    <strong>Address:</strong> {{ $student->address }}
                </div>
                <div class="mb-3">
                    <strong>Blood Group:</strong> {{ $student->blood_group }}
                </div>
                <div class="mb-3">
                    <strong>Nationality:</strong> {{ $student->nationality }}
                </div>
                <div class="mb-3">
                    <strong>Religion:</strong> {{ $student->religion }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
