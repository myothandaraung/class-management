@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">{{ $department->name }}</h2>
                <div class="btn-group">
                    <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> 編集
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{ route('departments.destroy', $department) }}')">
                        <i class="fas fa-trash me-1"></i> 削除
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Department Thumbnail and Basic Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $department->thumbnail) }}" 
                             alt="{{ $department->name }}" 
                             class="img-fluid rounded-circle mb-3" 
                             style="width: 200px; height: 200px; object-fit: cover;">
                        <h3 class="mb-1">{{ $department->name }}</h3>
                        <p class="text-muted mb-3">部署概要</p>
                    </div>
                    
                    <div class="bg-light p-3 rounded-3">
                        <div class="mb-2">
                            <span class="text-muted me-2">作成日:</span>
                            <span>{{ $department->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="text-muted me-2">更新日:</span>
                            <span>{{ $department->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Department Description -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-align-left text-primary me-3" style="font-size: 2rem"></i>
                        <h4 class="mb-0">説明</h4>
                    </div>
                    
                    <div class="bg-light p-4 rounded-3">
                        <p class="mb-0">{{ $department->description ?: '説明がありません' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Courses Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">関連コース</h4>
                        <a href="{{ route('courses.create') }}?department={{ $department->id }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus me-1"></i> コース追加
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>コース名</th>
                                    <th>年</th>
                                    <th>作成日</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($department->courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->year }}</td>
                                    <td>{{ $course->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-book-open fa-3x mb-3"></i>
                                            <p class="mb-0">この部署にコースが追加されていません。</p>
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
<script>
function confirmDelete(url) {
    if (confirm('Are you sure you want to delete this department? This action cannot be undone.')) {
        document.getElementById('delete-form').action = url;
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush
