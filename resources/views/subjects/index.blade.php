@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">科目一覧</h2>
                <a href="{{ route('subjects.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> 新しい科目を追加
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">番号</th>
                                    <th class="text-center">科目名</th>
                                    <th class="text-center">コード</th>
                                    <th class="text-center">種類</th>
                                    <th class="text-center">説明</th>
                                    <th class="text-center">関連コース</th>
                                    <th class="text-center">関連教師</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $subject)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $subject->name }}</td>
                                    <td class="text-center">{{ $subject->code }}</td>
                                    <td class="text-center">{{ $subject->type }}</td>
                                    <td class="text-center">{{ Str::limit($subject->description, 50) }}</td>
                                    <td class="text-center">
                                        <div class="d-flex flex-wrap gap-2">
                                            @forelse($subject->courses as $course)
                                                <span class="badge bg-primary">{{ $course->name }}</span>
                                            @empty
                                                <span class="text-muted">なし</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-wrap gap-2">
                                            @forelse($subject->teachers as $teacher)
                                                <span class="badge bg-secondary">{{ $teacher->name }}</span>
                                            @empty
                                                <span class="text-muted">なし</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-sm btn-info" title="詳細">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-warning" title="編集">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display: inline-block; margin-bottom: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteSubject(event, {{ $subject->id }})" title="削除">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-book-open fa-3x mb-3"></i>
                                            <p class="mb-0">科目が登録されていません</p>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteSubject(event, subjectId) {
    event.preventDefault();
    
    Swal.fire({
        title: '本当に削除しますか？',
        text: 'この操作は取り消せません',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '削除',
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
