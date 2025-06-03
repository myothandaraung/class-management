<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }
        .header {
            background-color: #1a73e8;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
        }
        .section {
            margin-bottom: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .section h2 {
            color: #1a73e8;
            margin-bottom: 15px;
        }
        .section p {
            margin-bottom: 10px;
        }
        .success-icon {
            color: #1a73e8;
            font-size: 24px;
            margin-right: 10px;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #1a73e8;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            color: #6c757d;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>お支払い完了のお知らせ</h1>
        </div>
        
        <div class="content">
            <div class="section">
                <div class="d-flex align-items-center">
                    <i class="fa fa-check-circle success-icon"></i>
                    <h2>お支払いが完了しました</h2>
                </div>
                <p>こんにちは、{{ $student->first_name }} {{ $student->last_name }}様</p>
                <p>ご登録ありがとうございます。以下の内容で支払いが完了いたしました。</p>
            </div>

            <div class="section">
                <h2>支払い詳細</h2>
                <p><strong>クラス名:</strong> {{ $enrollment->class->name }}</p>
                <p><strong>支払金額:</strong> <span class="amount">{{ number_format($payment->amount) }}円</span></p>
                <p><strong>支払日:</strong> {{ $payment->payment_date }}</p>
                <p><strong>登録日:</strong> {{ $enrollment->enrollment_date }}</p>
            </div>

            <div class="section">
                <h2>お問い合わせ</h2>
                <p>ご不明な点がございましたら、お気軽にお問い合わせください。</p>
                <p>メール: support@example.com</p>
                <p>電話: 03-1234-5678</p>
            </div>
        </div>

        <div class="footer">
            <p>© 2025 クラス管理システム</p>
        </div>
    </div>
</body>
</html>