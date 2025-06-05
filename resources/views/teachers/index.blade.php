@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">教師一覧</h4>
                    <a href="{{ route('teachers.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-2"></i> 新しい教師を追加
                    </a>
                </div>
                <div class="card-body">
                    {{-- search form --}}
                    <div class="mb-4">
                        <form action="{{ route('teachers.index') }}" method="GET" class="row g-3">
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
                                    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
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
                                    <th class="text-center">性別</th>
                                    <th class="text-center">学部</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                <tr>
                                    <td class="text-center">{{ $teacher->id }}</td>
                                    <td class="text-center">
                                        <div class="teacher-image-container">
                                            @if($teacher->thumbnail)
                                                <img src="{{ $teacher->thumbnail ? url('storage/' . $teacher->thumbnail) : asset('images/default-avatar.png') }}" 
                                                     alt="{{ $teacher->full_name }}" 
                                                     class="teacher-image rounded-3">
                                            @else
                                                <div class="teacher-image-placeholder rounded-3">
                                                    <i class="fas fa-user text-muted"></i>
                                                    <p class="text-muted mt-2">画像がありません</p>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $teacher->full_name }}</td>
                                    <td class="text-center">{{ $teacher->user->email }}</td>
                                    <td class="text-center">{{ $teacher->phone }}</td>
                                    <td class="text-center">{{ $teacher->gender }}</td>
                                    <td class="text-center">{{ $teacher->department->name ?? '未設定' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-sm btn-info" title="詳細">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning" title="編集">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display: inline-block; margin-bottom: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteTeacher(event, {{ $teacher->id }})" title="削除">
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
                                <p class="mb-0">{{ $teachers->firstItem() }} から {{ $teachers->lastItem() }} までを表示中 (合計 {{ $teachers->total() }} 件)</p>
                            </div>
                            <div>
                                {{ $teachers->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<style>
    .teacher-image-container {
        width: 50px;
        height: 50px;
        margin: auto;
    }
    
    .teacher-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .teacher-image:hover {
        transform: scale(1.1);
    }
    
    .teacher-image-placeholder {
        width: 50px;
        height: 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border: 2px solid #dee2e6;
    }
    
    .table {
        --bs-table-hover-bg: rgba(0, 0, 0, 0.05);
    }
    
    .btn-group .btn {
        padding: 0.3rem 0.6rem;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteTeacher(event, teacherId) {
        event.preventDefault();
        Swal.fire({
            title: '削除確認',
            text: '本当にこの教師を削除しますか？',
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
