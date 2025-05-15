@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary fw-bold">コース編集</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i> 戻る
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-building me-2 text-primary"></i>
                            <h5 class="card-title mb-0">{{ $course->department->name }}</h5>
                        </div>
                        <div class="text-muted small">
                            <i class="fas fa-clock me-1"></i>
                            {{ $course->created_at->format('Y/m/d H:i') }}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.update', $course) }}" method="POST" class="row g-4">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" 
                                       value="{{ old('name', $course->name) }}" required>
                                <label for="name">コース名</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('department_id') is-invalid @enderror" 
                                        id="department_id" name="department_id" required>
                                    <option value="">選択してください</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" 
                                                {{ old('department_id', $course->department_id) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="department_id">部署</label>
                                @error('department_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                       id="year" name="year" 
                                       value="{{ old('year', $course->year) }}" required
                                       min="{{ date('Y') - 5 }}" max="{{ date('Y') }}">
                                <label for="year">年度</label>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" 
                                       value="{{ old('price', $course->price) }}">
                                <label for="price">価格（円）</label>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4">{{ old('description', $course->description) }}</textarea>
                                <label for="description">説明</label>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> 保存
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
