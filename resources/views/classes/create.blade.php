@extends('layouts.app')

@section('title', 'クラス作成')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">クラス作成</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="name" class="form-label">クラス名</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="course_id" class="form-label">コース</label>
                    <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                        <option value="">選択してください</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="start_date" class="form-label">開始日</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">終了日</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="description" class="form-label">説明</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="thumbnail" class="form-label">クラス画像</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" onchange="previewImage(this)">
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="image-preview" id="imagePreview">
                        <img id="previewImage" src="" alt="プレビュー" style="max-width: 100%; display: none;">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>作成
                    </button>
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-arrow-left me-2"></i>戻る
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('previewImage').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Add date validation
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    if (startDate && endDate) {
        startDate.addEventListener('change', function() {
            const start = new Date(this.value);
            const end = new Date(endDate.value);
            
            if (end && end <= start) {
                endDate.setCustomValidity('終了日は開始日より後でなければなりません');
                endDate.style.borderColor = 'red';
            } else {
                endDate.setCustomValidity('');
                endDate.style.borderColor = '';
            }
        });

        endDate.addEventListener('change', function() {
            const start = new Date(startDate.value);
            const end = new Date(this.value);
            
            if (end <= start) {
                this.setCustomValidity('終了日は開始日より後でなければなりません');
                this.style.borderColor = 'red';
            } else {
                this.setCustomValidity('');
                this.style.borderColor = '';
            }
        });
    }
</script>
@endsection
