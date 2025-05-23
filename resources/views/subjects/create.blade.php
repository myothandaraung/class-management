@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">新しい科目の追加</h2>
                <div class="btn-group">
                    <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list me-1"></i> 科目一覧
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('subjects.store') }}" method="POST" class="row g-4">
                        @csrf

                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">科目名 *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-book"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-0 shadow-sm @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="code" class="form-label fw-bold">コード *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-hashtag"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-0 shadow-sm @error('code') is-invalid @enderror" 
                                       id="code" 
                                       name="code" 
                                       value="{{ old('code') }}" 
                                       required>
                            </div>
                            @error('code')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="type" class="form-label fw-bold">種類 *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-tag"></i>
                                </span>
                                <select class="form-select border-0 shadow-sm @error('type') is-invalid @enderror" 
                                        id="type" 
                                        name="type" 
                                        required>
                                    <option value="">選択してください</option>
                                    <option value="必修" {{ old('type') == '必修' ? 'selected' : '' }}>必修</option>
                                    <option value="選択" {{ old('type') == '選択' ? 'selected' : '' }}>選択</option>
                                    <option value="特別" {{ old('type') == '特別' ? 'selected' : '' }}>特別</option>
                                </select>
                            </div>
                            @error('type')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label fw-bold">説明</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                <textarea class="form-control border-0 shadow-sm @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">関連コース *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-graduation-cap"></i>
                                </span>
                                <select class="form-select border-0 shadow-sm @error('courses') is-invalid @enderror" 
                                        id="courses" 
                                        name="courses[]" 
                                        multiple 
                                        required>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ in_array($course->id, old('courses', [])) ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('courses')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="col-12">
                            <label class="form-label fw-bold">関連教師 *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </span>
                                <select class="form-select border-0 shadow-sm @error('teachers') is-invalid @enderror" 
                                        id="teachers" 
                                        name="teachers[]" 
                                        multiple 
                                        required>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ in_array($teacher->id, old('teachers', [])) ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('teachers')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save me-2"></i> 科目を追加
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Add live search to select boxes
$(document).ready(function() {
    $('#courses').select2({
        placeholder: 'コースを選択',
        width: '100%'
    });

    $('#teachers').select2({
        placeholder: '教師を選択',
        width: '100%'
    });
});
</script>
@endpush
