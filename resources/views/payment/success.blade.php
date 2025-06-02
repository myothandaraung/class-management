
Proposed edit:
success.blade.php
+32
-0
 0
Apply
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">お支払い完了</h3>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
                        <h4 class="mb-4">お支払いが正常に完了しました</h4>
                        <p class="text-muted mb-4">
                            登録情報は正常に保存されました。<br>
                            クラスに参加できるようになります。
                        </p>
                        
                        <div class="mt-4">
                            <a href="{{ route('enrollments.index') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>クラス一覧に戻る
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
