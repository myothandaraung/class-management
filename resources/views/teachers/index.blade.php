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
                                        <img src="{{ $teacher->thumbnail ? url('storage/' . $teacher->thumbnail) : asset('images/default-avatar.png') }}" 
                                             alt="{{ $teacher->full_name }}" 
                                             class="img-thumbnail" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td class="text-center">{{ $teacher->full_name }}</td>
                                    <td class="text-center">{{ $teacher->email }}</td>
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
                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline">
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

@push('styles')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endpush

@push('scripts')
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
@endpush
