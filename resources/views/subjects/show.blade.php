@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">科目詳細</h2>
                <div class="btn-group">
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-2"></i> 編集
                    </a>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> 戻る
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="card-title mb-1">科目名</h5>
                                <p class="mb-0">{{ $subject->name }}</p>
                            </div>
                            <div class="mb-4">
                                <h5 class="card-title mb-1">コード</h5>
                                <p class="mb-0">{{ $subject->code }}</p>
                            </div>
                            <div class="mb-4">
                                <h5 class="card-title mb-1">種類</h5>
                                <span class="badge bg-primary">{{ $subject->type }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="card-title mb-1">説明</h5>
                                <p class="mb-0">{{ $subject->description ?? 'なし' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="card-title mb-1">関連コース</h5>
                                @forelse($subject->courses as $course)
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-primary me-2">{{ $course->name }}</span>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $course->year }}年度
                                        </small>
                                    </div>
                                @empty
                                    <p class="text-muted">関連するコースはありません</p>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="card-title mb-1">関連教師</h5>
                                @forelse($subject->teachers as $teacher)
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-secondary me-2">{{ $teacher->name }}</span>
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>
                                            {{ $teacher->email }}
                                        </small>
                                    </div>
                                @empty
                                    <p class="text-muted">関連する教師はありません</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
