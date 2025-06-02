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
                                        <td>{{ $enrollment->student->name }}</td>
                                        <td>{{ $enrollment->class->name }}</td>
                                        <td class="text-end">{{ number_format($enrollment->class->price) }}円</td>
                                        <td class="text-center">{{ $enrollment->enrollment_date->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : 'secondary' }}">
                                                {{ $enrollment->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
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
@endsection
