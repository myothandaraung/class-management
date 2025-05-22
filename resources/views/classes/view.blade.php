@extends('layouts.app')

@section('title', 'クラス詳細')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $class->name }}</h5>
        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>戻る
        </a>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <!-- Class Image -->
            <div class="col-md-4">
                @if($class->image)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <img src="{{ asset('storage/' . $class->image) }}" 
                                 class="img-fluid rounded-3" 
                                 alt="クラス画像" 
                                 style="max-height: 300px; object-fit: cover;">
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <h6 class="text-muted mb-0">クラス画像</h6>
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="text-muted mt-2">画像がありません</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Class Information -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-book-reader text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-muted mb-1">名前</h6>
                                        <p class="mb-0 fw-semibold">{{ $class->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-book text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-muted mb-1">コース</h6>
                                        <p class="mb-0 fw-semibold">{{ $class->course->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-muted mb-1">開始日</h6>
                                        <p class="mb-0 fw-semibold">{{ $class->start_date->format('Y年m月d日') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-check text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-muted mb-1">終了日</h6>
                                        <p class="mb-0 fw-semibold">{{ $class->end_date->format('Y年m月d日') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-align-left text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-muted mb-1">説明</h6>
                                        <p class="mb-0">{{ $class->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-4">
            <div class="d-flex gap-3">
                <a href="{{ route('classes.edit', $class) }}" class="btn btn-outline-warning">
                    <i class="fas fa-edit me-2"></i>編集
                </a>
                <form action="{{ route('classes.destroy', $class) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか？')">
                        <i class="fas fa-trash me-2"></i>削除
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
        border-radius: 0.75rem;
    }

    .card-header {
        background-color: var(--background-color);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem;
    }

    .card-footer {
        background-color: var(--background-color);
        border-top: 1px solid var(--border-color);
        padding: 0.75rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .text-primary {
        color: var(--primary-color) !important;
    }

    .btn-outline-secondary {
        color: var(--text-color);
        border-color: var(--border-color);
    }

    .btn-outline-secondary:hover {
        background-color: var(--light-color);
        color: var(--dark-color);
    }

    .btn-outline-warning {
        color: var(--warning-color);
        border-color: var(--warning-color);
    }

    .btn-outline-warning:hover {
        background-color: var(--warning-color);
        color: white;
    }

    .btn-outline-danger {
        color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .btn-outline-danger:hover {
        background-color: var(--danger-color);
        color: white;
    }

    .fa-3x {
        opacity: 0.3;
    }
</style>
@endsection
