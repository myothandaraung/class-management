@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="text-primary fw-bold mb-0">クラス-科目-教師の関連</h1>
                <div class="d-flex gap-3">
                    <a href="{{ route('classSubjectTeachers.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> 新しい関連の追加
                    </a>
                </div>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">番号</th>
                                    <th class="text-center">クラス</th>
                                    <th class="text-center">科目</th>
                                    <th class="text-center">教師</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classSubjectTeachers as $classSubjectTeacher)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">{{ $classSubjectTeacher->class->name }}</h6>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar me-1"></i>
                                                        {{ $classSubjectTeacher->class->year }}年度
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">{{ $classSubjectTeacher->subject->name }}</h6>
                                                    <small class="text-muted">
                                                        <i class="fas fa-hashtag me-1"></i>
                                                        コード: {{ $classSubjectTeacher->subject->code }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3">
                                                    <h6 class="mb-0">{{ $classSubjectTeacher->teacher->getFullNameAttribute() }}</h6>
                                                    <small class="text-muted">
                                                        <i class="fas fa-envelope me-1"></i>
                                                        {{ $classSubjectTeacher->teacher->user->email }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('classSubjectTeachers.show', $classSubjectTeacher) }}" class="btn btn-sm btn-info" title="詳細">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('classSubjectTeachers.edit', $classSubjectTeacher) }}" class="btn btn-sm btn-warning" title="編集">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('classSubjectTeachers.destroy', $classSubjectTeacher) }}" method="POST" style="display: inline-block; margin-bottom: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteClassSubjectTeacher(event, {{ $classSubjectTeacher->id }})" title="削除">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-box-open fa-3x mb-3"></i>
                                                <p class="mb-0">関連が見つかりません</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteClassSubjectTeacher(event, id) {
        event.preventDefault();
        
        Swal.fire({
            title: '確認',
            text: 'この関連を削除しますか？',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '削除',
            confirmButtonColor: '#d33',
            cancelButtonText: 'キャンセル',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });
    }
</script>