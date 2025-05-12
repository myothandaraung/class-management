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
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('本当に削除しますか？')" title="削除">
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
<style>
    .table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.075);
    }
    
    .btn-group {
        gap: 0.5rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
    }
    
    .pagination .page-link {
        color: #0d6efd;
        border-color: #dee2e6;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
@endpush

@push('scripts')
<script>
    // Add smooth scrolling to pagination links
    document.querySelectorAll('.page-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            window.location.href = url;
        });
    });
</script>
@endpush
@endsection
