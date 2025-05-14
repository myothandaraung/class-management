@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary fw-bold">コース一覧</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> 新しいコースを追加
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row g-4">
        @forelse($courses as $course)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title mb-1">{{ $course->name }}</h5>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $course->year }}年度
                            </small>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.show', $course) }}">
                                        <i class="fas fa-eye me-2"></i> 詳細
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.edit', $course) }}">
                                        <i class="fas fa-edit me-2"></i> 編集
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="dropdown-item text-danger" onclick="deleteCourse(event, {{ $course->id }})">
                                            <i class="fas fa-trash me-2"></i> 削除
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-muted mb-2">関連科目</h6>
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

                    <div class="mb-3">
                        <h6 class="text-muted mb-2">関連教師</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($course->teachers as $teacher)
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                    {{ $teacher->name }}
                                </span>
                            @empty
                                <span class="text-muted">なし</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            {{ $course->created_at->format('Y/m/d') }}
                        </small>
                        @if($course->price)
                        <span class="badge bg-success">
                            <i class="fas fa-tag me-1"></i>
                            {{ $course->price }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted">
                <i class="fas fa-book-open fa-3x mb-3"></i>
                <h3>コースが登録されていません</h3>
                <p class="mb-4">新しいコースを追加してください</p>
                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> 新しいコースを追加
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteCourse(event, courseId) {
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
