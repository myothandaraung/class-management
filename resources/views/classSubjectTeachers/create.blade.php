@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="text-primary fw-bold mb-0">新しい関連の追加</h1>
                <a href="{{ route('classSubjectTeachers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> 戻る
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <form action="{{ route('classSubjectTeachers.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="class_id" class="form-label">クラス</label>
                                <select name="class_id" id="class_id" class="form-select @error('class_id') is-invalid @enderror">
                                    <option value="">選択してください</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}" 
                                                data-year="{{ $class->year }}">
                                            {{ $class->name }} ({{ $class->year }}年度)
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="subject_id" class="form-label">科目</label>
                                <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                                    <option value="">選択してください</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">
                                            {{ $subject->name }} ({{ $subject->code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="teacher_id" class="form-label">教師</label>
                                <select name="teacher_id" id="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror">
                                    <option value="">選択してください</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->getFullNameAttribute() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> 保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection