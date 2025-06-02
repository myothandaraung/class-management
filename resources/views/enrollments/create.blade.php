@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h3 class="mb-0">{{ __('新規登録') }}</h3>
                </div>

                <div class="card-body">
                    <form id="enrollmentForm" method="POST" action="{{ route('enrollments.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="student_id" class="form-label">生徒</label>
                                <select id="student_id" class="form-select @error('student_id') is-invalid @enderror" name="student_id" required>
                                    <option value="">生徒を選択してください</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" data-fullname="{{ $student->getFullNameAttribute() }}">{{ $student->getFullNameAttribute() }}</option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="class_id" class="form-label">クラス</label>
                                <select id="class_id" class="form-select @error('class_id') is-invalid @enderror" name="class_id" required>
                                    <option value="">クラスを選択してください</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}" data-name="{{ $class->name }}" data-price="{{ $class->price }}">{{ $class->name }} (¥{{ number_format($class->price) }})</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="enrollment_date" class="form-label">登録日</label>
                                <input id="enrollment_date" type="date" class="form-control @error('enrollment_date') is-invalid @enderror" 
                                       name="enrollment_date" value="{{ old('enrollment_date', date('Y-m-d')) }}" required>
                                @error('enrollment_date')
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">ステータス</label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                                    <option value="active">アクティブ</option>
                                    <option value="inactive">非アクティブ</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('enrollments.index') }}" class="btn btn-outline-secondary">戻る</a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                <i class="fas fa-check me-2"></i>確認
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="confirmModalLabel">登録確認</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="confirmContent" class="text-center">
                    <!-- Confirmation content will be populated by JavaScript -->
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">戻る</button>
                <button type="button" class="btn btn-success" id="confirmSubmit">
                    <i class="fas fa-check me-2"></i>支払い
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
let payment_status = 'false';
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('enrollmentForm');
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    const confirmSubmit = document.getElementById('confirmSubmit');
    const confirmContent = document.getElementById('confirmContent');

    // confirmSubmit.addEventListener('click', function() {
    //     form.submit();
    // });

    document.getElementById('confirmModal').addEventListener('show.bs.modal', function() {
        const student = document.getElementById('student_id').options[document.getElementById('student_id').selectedIndex];
        const classOption = document.getElementById('class_id').options[document.getElementById('class_id').selectedIndex];
        const enrollmentDate = document.getElementById('enrollment_date').value;
        const status = document.getElementById('status').value;

        const studentName = student.getAttribute('data-fullname');
        const className = classOption.getAttribute('data-name');
        const classPrice = classOption.getAttribute('data-price');

        confirmContent.innerHTML = `
            <div class="mb-3">
                <strong>生徒名:</strong> ${studentName}
            </div>
            <div class="mb-3">
                <strong>クラス:</strong> ${className}
            </div>
            <div class="mb-3">
                <strong>料金:</strong> ¥${classPrice}
            </div>
            <div class="mb-3">
                <strong>登録日:</strong> ${enrollmentDate}
            </div>
            <div>
                <strong>ステータス:</strong> ${status === 'active' ? 'アクティブ' : '非アクティブ'}
            </div>
        `;
    });
    confirmSubmit.addEventListener('click', async function() {
        this.textContent = "処理中。。。。"
        this.disabled = true;
        const student = document.getElementById('student_id').options[document.getElementById('student_id').selectedIndex];
        const classOption = document.getElementById('class_id').options[document.getElementById('class_id').selectedIndex];
        const enrollmentDate = document.getElementById('enrollment_date').value;
        const status = document.getElementById('status').value;
        const classPrice = classOption.getAttribute('data-price');
        console.log(classPrice);
        const stripe = Stripe('{{ $stripe_key }}');
        try {
            const { data }  = await axios.post("{{ route('payment') }}",
                        {
                            student_id:student.value,
                            class_id:classOption.value,
                            enrollment_date:enrollmentDate,
                            // status:status,
                            price:classPrice});
            console.log(data.id);
            const { error } = await stripe.redirectToCheckout({
            sessionId: data.id,
            });

            if (error) {
                console.log(error);
                this.textContent = "支払い";
                this.disabled = false;
                confirmModal.hide();
            }
            if(data.status == 200){
                // const enrollmentData = axios.post(route('enrollments.store'),{student_id:student.value,class_id:classOption.value,enrollment_date:enrollmentDate,status:status});
                // if(enrollmentData.status == 200){
                //     payment_status = 'true';
                //     this.textContent = "支払い";
                //     this.disabled = false;
                //     confirmModal.hide();
                // }
            }
            
        } catch (error) {
            console.log(error);
        }
    });
});
</script>
@endsection