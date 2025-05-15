@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary fw-bold">コース詳細</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-2"></i> 編集
            </a>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">
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
                    <div class="row g-4">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <h5 class="mb-3">基本情報</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th class="text-muted">コース名</th>
                                            <td>
                                                <h4 class="mb-0">{{ $course->name }}</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">年度</th>
                                            <td>
                                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ $course->year }}年度
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">価格</th>
                                            <td>
                                                @if($course->price)
                                                    <span class="badge bg-success bg-opacity-10 text-success">
                                                        <i class="fas fa-tag me-1"></i>
                                                        {{ number_format($course->price) }} 円
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                        無料
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">説明</th>
                                            <td>
                                                <p class="text-muted mb-0">
                                                    {{ $course->description ?: '説明がありません' }}
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-4">
                                <h5 class="mb-3">関連情報</h5>
                                <div class="mb-4">
                                    <h6 class="text-muted mb-3">関連科目</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        {{-- @forelse($course->subjects as $subject) --}}
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                DBMS
                                            </span>
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                AI
                                            </span>
                                        {{-- @empty --}}
                                            <span class="text-muted">なし</span>
                                        {{-- @endforelse --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-5">
                            <div class="mb-4">
                                <h5 class="mb-3">関連情報</h5>
                                <div class="mb-4">
                                    <h6 class="text-muted mb-3">関連科目</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @forelse($course->subjects as $subject)
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                {{ $subject->name }}
                                            </span>
                                        @empty
                                            <span class="text-muted">なし</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer bg-white border-top">
                    <div class="text-muted small">
                        <i class="fas fa-info-circle me-1"></i>
                        最終更新: {{ $course->updated_at->format('Y/m/d H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
