@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">生徒プロフィール</h4>
                    <div class="btn-group">
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm me-2">
                            <i class="fas fa-edit"></i> 編集
                        </a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当にこの生徒を削除しますか？')">
                                <i class="fas fa-trash"></i> 削除
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-4 text-center">
                            <div class="position-relative">
                                <img src="{{ $student->thumbnail ? url('storage/' . $student->thumbnail) : asset('images/default-avatar.png') }}" 
                                     alt="{{ $student->full_name }}" 
                                     class="img-fluid rounded-circle shadow-sm" 
                                     style="width: 200px; height: 200px; object-fit: cover;">
                                <div class="position-absolute bottom-0 start-50 translate-middle-x p-2 bg-white rounded-circle shadow-sm">
                                    <span class="badge bg-success">アクティブ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3 class="mb-3">{{ $student->full_name }}</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <i class="fas fa-envelope text-primary me-2"></i> 
                                        <span class="text-muted">メールアドレス:</span> {{ $student->user->email }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <i class="fas fa-phone text-primary me-2"></i> 
                                        <span class="text-muted">電話番号:</span> {{ $student->phone }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <i class="fas fa-calendar text-primary me-2"></i> 
                                        <span class="text-muted">生年月日:</span> {{ $student->date_of_birth }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <i class="fas fa-venus-mars text-primary me-2"></i> 
                                        <span class="text-muted">性別:</span> {{ $student->gender }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-lg">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">連絡先情報</h5>
                                    <div class="mb-3">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i> 
                                        <span class="text-muted">住所:</span> {{ $student->address }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0 rounded-lg">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">個人情報</h5>
                                    <div class="mb-3">
                                        <i class="fas fa-flag text-primary me-2"></i> 
                                        <span class="text-muted">国籍:</span> {{ $student->nationality }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
