<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クラス管理システム - アカウント作成完了</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .panel {
            background-color: #f8f8f8;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>クラス管理システムへようこそ！</h1>
        </div>

        <div class="content">
            <p>こんにちは、{{ $user->teacher->first_name }} {{ $user->teacher->last_name }}様。</p>
            
            <p>あなたの教師アカウントが正常に作成されました。</p>
            <p>以下のアカウント情報をご確認ください：</p>

            <div class="panel">
                <p>お名前: {{ $user->teacher->first_name }} {{ $user->teacher->last_name }}</p>
                <p>メールアドレス: {{ $user->email }}</p>
                <p>電話番号: {{ $user->teacher->phone }}</p>
                <p>生年月日: {{ $user->teacher->date_of_birth }}</p>
                <p>性別: {{ $user->teacher->gender }}</p>
                <p>住所: {{ $user->teacher->address }}</p>
            </div>

            <p>アカウントにログインして、クラス管理システムの機能をご利用ください。</p>
            <a href="{{ config('app.url') }}" class="button">ダッシュボードに移動</a>

            <p>ご不明な点がございましたら、お気軽にお問い合わせください。</p>
        </div>

        <div class="footer">
            <p>敬具、</p>
            <p>{{ config('app.name') }} チーム</p>
        </div>
    </div>
</body>
</html>