@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary fw-bold">コース作成</h2>
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
                                <select class="form-select border-0 shadow-sm @error('department_id') is-invalid @enderror" 
                                        id="department_id" 
                                        name="department_id" 
                                        required>
                                    <option value="">選択してください</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="department_id" class="form-label fw-bold">
                                    <i class="fas fa-building me-2"></i> 学科名 *
                                </label>
                            </div>
                            @error('department_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

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

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control border-0 shadow-sm @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3"
                                          placeholder="コースの詳細な説明を入力してください...">
                                    {{ old('description') }}
                                </textarea>
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-info-circle me-2"></i> 課程説明
                                </label>
                            </div>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select border-0 shadow-sm @error('year') is-invalid @enderror" 
                                        id="year" 
                                        name="year" 
                                        required>
                                    @php
                                        $currentYear = date('Y');
                                        for ($i = $currentYear - 5; $i <= $currentYear; $i++) {
                                            echo '<option value="' . $i . '" ' . (old('year') == $i ? 'selected' : '') . '>' . $i . '年度</option>';
                                        }
                                    @endphp
                                </select>
                                <label for="year" class="form-label fw-bold">
                                    <i class="fas fa-calendar me-2"></i> 年度 *
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
