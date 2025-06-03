@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">{{ __('登録一覧') }}</h2>
                <a href="{{ route('enrollments.create') }}" class="btn btn-primary">新規登録</a>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">生徒名</th>
                                    <th class="text-center">クラス名</th>
                                    <th class="text-center">料金</th>
                                    <th class="text-center">登録日</th>
                                    <th class="text-center">ステータス</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrollments as $enrollment)
                                    <tr>
                                        <td class="text-center">{{ $enrollment->student->getFullNameAttribute() }}</td>
                                        <td class="text-center">{{ $enrollment->class->name }}</td>
                                        <td class="text-center">{{ number_format($enrollment->class->price) }}円</td>
                                        <td class="text-center">{{ $enrollment->enrollment_date }}</td>
                                        <td class="text-center">
                                            <span class="alert alert-{{ $enrollment->status === 'active' ? 'success' : 'secondary' }} p-1">
                                                {{ $enrollment->status === 'active' ? '有効' : '無効' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary me-1" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#statusModal{{ $enrollment->id }}">
                                                    編集ステータス
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Edit Modal -->
@php
    $modalId = 'statusModal';
@endphp
@foreach($enrollments as $enrollment)
<div class="modal fade" id="{{ $modalId }}{{ $enrollment->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ステータス編集</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('enrollments.update', $enrollment->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">現在のステータス</label>
                        <div class="text-center">
                            <span class="alert alert-{{ $enrollment->status === 'active' ? 'success' : 'secondary' }} p-1">
                                {{ $enrollment->status === 'active' ? '有効' : '無効' }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">新しいステータス</label>
                        <select class="form-select" name="status" required>
                            <option value="active" {{ $enrollment->status === 'active' ? 'selected' : '' }}>
                                <span class="bg-success">有効</span>
                            </option>
                            <option value="inactive" {{ $enrollment->status === 'inactive' ? 'selected' : '' }}>
                                <span class="bg-secondary">無効</span>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
