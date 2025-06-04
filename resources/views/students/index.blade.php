@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">生徒一覧</h4>
                    <a href="{{ route('students.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-2"></i> 新しい生徒を追加
                    </a>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <div class="mb-4">
                        <form action="{{ route('students.index') }}" method="GET" class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="名前またはメールアドレスで検索" value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i> 検索
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-sync-alt"></i> リセット
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">プロフィール</th>
                                    <th class="text-center">名前</th>
                                    <th class="text-center">メールアドレス</th>
                                    <th class="text-center">電話番号</th>
                                    <th class="text-center">生年月日</th>
                                    <th class="text-center">性別</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td class="text-center">{{ $student->id }}</td>
                                    <td class="text-center">
                                        <img src="{{ $student->thumbnail ? url('storage/' . $student->thumbnail) : asset('images/default-avatar.png') }}" 
                                             alt="{{ $student->full_name }}" 
                                             class="img-thumbnail" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td class="text-center">{{ $student->full_name }}</td>
                                    <td class="text-center">{{ $student->user->email }}</td>
                                    <td class="text-center">{{ $student->phone }}</td>
                                    <td class="text-center">{{ $student->date_of_birth }}</td>
                                    <td class="text-center">{{ $student->gender }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info" title="詳細">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning" title="編集">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteStudent(event, {{ $student->id }})" title="削除">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">{{ $students->firstItem() }} から {{ $students->lastItem() }} までを表示中 (合計 {{ $students->total() }} 件)</p>
                            </div>
                            <div>
                                {{ $students->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endpush

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    // Add smooth scrolling to pagination links
    $(document).ready(function() {
        $('.page-link').click(function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            window.location.href = url;
        });
    });

    function deleteStudent(event, studentId) {
        event.preventDefault();
        Swal.fire({
            title: '削除確認',
            text: '本当にこの生徒を削除しますか？',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '削除する',
            cancelButtonText: 'キャンセル',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });
    }
</script>

@endsection
