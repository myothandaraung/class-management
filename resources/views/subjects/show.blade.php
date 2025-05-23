@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="text-primary fw-bold mb-0">科目詳細</h1>
                <div class="btn-group">
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-2"></i> 編集
                    </a>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> 戻る
                    </a>
                </div>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <h5 class="card-title mb-2 text-primary">科目名</h5>
                                <p class="fs-4 mb-0 fw-semibold">{{ $subject->name }}</p>
                            </div>
                            <div class="mb-5">
                                <h5 class="card-title mb-2 text-primary">コード</h5>
                                <p class="fs-4 mb-0 fw-semibold">{{ $subject->code }}</p>
                            </div>
                            <div class="mb-5">
                                <h5 class="card-title mb-2 text-primary">種類</h5>
                                <span class="badge bg-primary px-3 py-2">{{ $subject->type }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <h5 class="card-title mb-2 text-primary">説明</h5>
                                <p class="mb-0">{{ $subject->description ?? 'なし' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 pt-4 border-top">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="card-title mb-3 text-primary">関連コース</h5>
                                @forelse($subject->courses as $course)
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-primary px-3 py-2 me-3">{{ $course->name }}</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
