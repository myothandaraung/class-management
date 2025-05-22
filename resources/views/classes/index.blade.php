@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>クラス一覧</h2>
        <a href="{{ route('classes.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>クラスの追加</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>クラス名</th>
                        <th>写真</th>
                        <th>コース</th>
                        <th>説明</th>
                        <th>開始日</th>
                        <th>終了日</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                        <tr>
                            <td>{{ $class->name }}</td>
                            <td class="text-center">
                                <div class="class-image-container">
                                    @if($class->thumbnail)
                                        <img src="{{ $class->thumbnail ? url('storage/' . $class->thumbnail) : asset('images/default-avatar.png') }}" 
                                            class="class-image" 
                                            alt="クラス画像">
                                    @else
                                        <div class="class-image-placeholder">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $class->course->name }}</td>
                            <td>{{ $class->description }}</td>
                            <td>{{ $class->start_date->format('Y-m-d') }}</td>
                            <td>{{ $class->end_date->format('Y-m-d') }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('classes.show', $class) }}" class="btn btn-sm btn-info" title="詳細">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('classes.edit', $class) }}" class="btn btn-sm btn-warning" title="編集">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('classes.destroy', $class) }}" method="POST" style="display: inline-block; margin-bottom: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteClass(event, {{ $class->id }})" title="削除">
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
    </div>
</div>
@endsection
<style>
    .class-image-container {
        width: 60px;
        height: 60px;
        margin: auto;
    }
    
    .class-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .class-image:hover {
        transform: scale(1.1);
    }
    
    .class-image-placeholder {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border: 2px solid #dee2e6;
    }
    
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteClass(event, id) {
        event.preventDefault();
        
        Swal.fire({
            title: '確認',
            text: 'このクラスを削除しますか？',
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
