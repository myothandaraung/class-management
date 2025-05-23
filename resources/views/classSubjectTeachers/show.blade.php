@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="text-primary fw-bold mb-0">関連の詳細</h1>
                <div class="d-flex gap-3">
                    <a href="{{ route('classSubjectTeachers.edit', $classSubjectTeacher) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i> 編集
                    </a>
                    <a href="{{ route('classSubjectTeachers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> 戻る
                    </a>
                </div>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light border-0 rounded-4">
                                <div class="card-body">
                                    <h5 class="card-title text-primary mb-3">クラス</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <h6 class="mb-1">{{ $classSubjectTeacher->class->name }}</h6>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $classSubjectTeacher->class->year }}年度
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card bg-light border-0 rounded-4">
                                <div class="card-body">
                                    <h5 class="card-title text-primary mb-3">科目</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <h6 class="mb-1">{{ $classSubjectTeacher->subject->name }}</h6>
                                            <small class="text-muted">
                                                <i class="fas fa-hashtag me-1"></i>
                                                コード: {{ $classSubjectTeacher->subject->code }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card bg-light border-0 rounded-4">
                                <div class="card-body">
                                    <h5 class="card-title text-primary mb-3">教師</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <h6 class="mb-1">{{ $classSubjectTeacher->teacher->getFullNameAttribute() }}</h6>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope me-1"></i>
                                                {{ $classSubjectTeacher->teacher->user->email }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection