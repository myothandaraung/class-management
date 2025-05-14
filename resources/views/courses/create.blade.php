@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary fw-bold">新しいコースの追加</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> 戻る
            </a>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('courses.store') }}" method="POST" class="row g-4">
                        @csrf

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" 
                                       class="form-control border-0 shadow-sm @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required>
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-book me-2"></i> コース名 *
                                </label>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select border-0 shadow-sm @error('year') is-invalid @enderror" 
                                        id="year" 
                                        name="year" 
                                        required>
                                    <option value="">選択してください</option>
                                    @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                                        <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}年度
                                        </option>
                                    @endfor
                                </select>
                                <label for="year" class="form-label fw-bold">
                                    <i class="fas fa-calendar me-2"></i> 年 *
                                </label>
                            </div>
                            @error('year')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" 
                                       class="form-control border-0 shadow-sm @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price') }}">
                                <label for="price" class="form-label fw-bold">
                                    <i class="fas fa-tag me-2"></i> 価格
                                </label>
                            </div>
                            @error('price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">
                                <i class="fas fa-graduation-cap me-2"></i> 関連科目 *
                            </label>
                            <div class="input-group">
                                <select class="form-select border-0 shadow-sm @error('subjects') is-invalid @enderror" 
                                        id="subjects" 
                                        name="subjects[]" 
                                        multiple 
                                        required>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ in_array($subject->id, old('subjects', [])) ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('subjects')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">
                                <i class="fas fa-chalkboard-teacher me-2"></i> 関連教師 *
                            </label>
                            <div class="input-group">
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
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save me-2"></i> コースを追加
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
    $('#subjects').select2({
        placeholder: '科目を選択',
        width: '100%'
    });

    $('#teachers').select2({
        placeholder: '教師を選択',
        width: '100%'
    });
});
</script>
@endpush
