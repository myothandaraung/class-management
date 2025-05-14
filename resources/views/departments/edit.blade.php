@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary fw-bold">編集</h2>
                <div class="btn-group">
                    <a href="{{ route('departments.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list me-1"></i> 部署一覧
                    </a>
                    <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-eye me-1"></i> 詳細
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Department Thumbnail -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="position-relative">
                            <img id="previewImage" src="{{ asset('storage/' . $department->thumbnail) }}" 
                                 alt="{{ $department->name }}" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="width: 200px; height: 200px; object-fit: cover;">
                            <div class="position-absolute bottom-0 start-50 translate-middle-x">
                                <label for="thumbnail" class="btn btn-sm btn-primary">
                                    <i class="fas fa-camera me-1"></i> 写真変更
                                </label>
                                <input type="file" 
                                       class="d-none" 
                                       id="thumbnail" 
                                       name="thumbnail" 
                                       accept="image/jpeg,image/png,image/gif" 
                                       onchange="window.previewImage(this)">
                            </div>
                        </div>
                        <h3 class="mb-1">{{ $department->name }}</h3>
                        <p class="text-muted mb-3">部署概要</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Department Information -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <form action="{{ route('departments.update', $department) }}" method="POST" class="row g-4">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">部署名 *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-building"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-0 shadow-sm @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $department->name) }}" 
                                       required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label fw-bold">説明</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-align-left"></i>
                                </span>
                                <textarea class="form-control border-0 shadow-sm @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3">{{ old('description', $department->description) }}</textarea>
                            </div>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save me-2"></i> 更新
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    // Function to preview image
    function previewImage(input) {
        console.log(input);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>