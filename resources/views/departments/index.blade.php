@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">部署一覧</h2>
                <a href="{{ route('departments.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> 新しい部署を追加
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">番号</th>
                                    <th class="text-center">部署名</th>
                                    <th class="text-center">説明</th>
                                    <th class="text-center">作成日時</th>
                                    <th class="text-center">画像</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($departments as $department)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $department->name }}</td>
                                    <td class="text-center">{{ $department->description }}</td>
                                    <td class="text-center">
                                        <img src="{{ $department->thumbnail ? url('storage/' . $department->thumbnail) : asset('images/default-avatar.png') }}" 
                                             alt="{{ $department->name }}" 
                                             class="img-thumbnail" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td class="text-center">{{ $department->created_at->format('Y/m/d H:i') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('departments.show', $department->id) }}" class="btn btn-sm btn-info" title="詳細">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-warning" title="編集">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: inline-block; margin-bottom: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteDepartment(event, {{ $department->id }})" title="削除">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">部署が見つかりませんでした</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">{{ $departments->firstItem() }} から {{ $departments->lastItem() }} までを表示中 (合計 {{ $departments->total() }} 件)</p>
                            </div>
                            <div>
                                {{ $departments->links('pagination::bootstrap-5') }}
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteDepartment(event, departmentId) {
    event.preventDefault();
    Swal.fire({
        title: '削除確認',
        text: '本当にこの部署を削除しますか？',
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
