@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">Add New Teacher</h2>
                <a href="{{ route('teachers.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i> Back to Teachers
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('teachers.store') }}" method="POST" class="row g-4">
                        @csrf
                        
                        <div class="col-md-6">
                            <label for="first_name" class="form-label fw-bold">First Name *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control border-0 shadow-sm @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            </div>
                            @error('first_name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="last_name" class="form-label fw-bold">Last Name *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control border-0 shadow-sm @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            </div>
                            @error('last_name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control border-0 shadow-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-bold">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="text" class="form-control border-0 shadow-sm @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            </div>
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label fw-bold">Date of Birth *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-calendar"></i>
                                </span>
                                <input type="date" class="form-control border-0 shadow-sm @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            </div>
                            @error('date_of_birth')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label fw-bold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <textarea class="form-control border-0 shadow-sm @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="subjects" class="form-label fw-bold">Subjects *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-book"></i>
                                </span>
                                <select class="form-select border-0 shadow-sm @error('subjects') is-invalid @enderror" id="subjects" name="subjects[]" multiple>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('subjects')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}">
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Teacher</button>
        </form>
    </div>
</div>
@endsection
