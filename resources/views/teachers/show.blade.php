@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">教師詳細</h4>
                    <div>
                        <a href="{{ route('teachers.index') }}" class="btn btn-light me-2">
                            <i class="fas fa-arrow-left me-2"></i> 戻る
                        </a>
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i> 編集
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <div class="teacher-profile-image">
                                @if($teacher->thumbnail)
                                    <img src="{{ $teacher->thumbnail ? url('storage/' . $teacher->thumbnail) : asset('images/default-avatar.png') }}" 
                                         alt="{{ $teacher->full_name }}" 
                                         class="teacher-image rounded-circle">
                                @else
                                    <div class="teacher-image-placeholder rounded-circle">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h3 class="mb-3">{{ $teacher->full_name }}</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>メールアドレス:</strong> {{ $teacher->user->email }}</p>
                                    <p><strong>電話番号:</strong> {{ $teacher->phone }}</p>
                                    <p><strong>性別:</strong> {{ $teacher->gender }}</p>
                                    <p><strong>誕生日:</strong> {{ $teacher->date_of_birth }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>学部:</strong> {{ $teacher->department->name ?? '未設定' }}</p>
                                    <p><strong>登録日:</strong> {{ $teacher->created_at->format('Y年m月d日') }}</p>
                                    <p><strong>最終更新:</strong> {{ $teacher->updated_at->format('Y年m月d日') }}</p>
                                    <p><strong>卒業:</strong> {{ $teacher->qualification }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">部署</h5>
                                </div>
                                <div class="card-body">
                                    @if($teacher->department)
                                        <p class="text-muted">{{ $teacher->department->name }}</p>
                                    @else
                                        <p class="text-muted">未設定</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">担当クラス</h5>
                                </div>
                                <div class="card-body">
                                    @if($teacher->classes->isEmpty())
                                        <p class="text-muted">この教師は現在、担当クラスがありません。</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>クラス名</th>
                                                        <th>コース</th>
                                                        <th>期間</th>
                                                        <th>学生数</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($teacher->classes as $class)
                                                        <tr>
                                                            <td>{{ $class->name }}</td>
                                                            <td>{{ $class->course->name }}</td>
                                                            <td>
                                                                {{ $class->start_date->format('Y年m月d日') }} - 
                                                                {{ $class->end_date->format('Y年m月d日') }}
                                                            </td>
                                                            <td>{{ $class->students->count() }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<style>
    .teacher-profile-image {
        width: 200px;
        height: 200px;
        margin: 0 auto;
    }
    
    .teacher-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }
    
    .teacher-image-placeholder {
        width: 200px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border: 2px solid #dee2e6;
    }
    
    .rounded-circle {
        border-radius: 50% !important;
    }
    
    .list-group-item {
        border-left: none;
        border-right: none;
    }
    
    .badge {
        padding: 0.5em 1em;
    }
</style>
@endpush
