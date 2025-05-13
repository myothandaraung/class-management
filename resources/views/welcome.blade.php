<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クラス管理システム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #c0392b;
            --info-color: #3498db;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --text-color: #2c3e50;
            --background-color: #f8f9fa;
            --card-border: #e0e0e0;
        }

        body {
            background-color: var(--background-color);
            min-height: 100vh;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--card-border);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .stats-section {
            padding: 4rem 0;
            background-color: var(--light-color);
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: 1px solid var(--card-border);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            color: var(--text-color);
            font-size: 1.1rem;
        }

        .cta-section {
            padding: 4rem 0;
            background: linear-gradient(135deg, var(--success-color), var(--info-color));
            color: white;
            text-align: center;
        }

        .cta-button {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 1rem 2rem;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            background: var(--light-color);
            transform: translateY(-2px);
        }

        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }

            .feature-card {
                padding: 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="container">
            <h1>クラス管理システム</h1>
            <p>効率的なクラス管理と教育管理のための統合プラットフォーム</p>
            {{-- <a href="{{ route('login') }}" class="btn btn-lg btn-light mt-4">ログイン</a> --}}
        </div>
    </div>

    <section class="features-section py-5">
        <div class="container">
            <h2 class="text-center mb-5">主要機能</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-users feature-icon"></i>
                        <h3>生徒管理</h3>
                        <p>生徒の詳細情報、成績、出席状況を一元管理</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-chalkboard-teacher feature-icon"></i>
                        <h3>教師管理</h3>
                        <p>教師のスケジュール、評価、資格情報を管理</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-book feature-icon"></i>
                        <h3>コース管理</h3>
                        <p>コースの設定、スケジュール、進捗管理</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <h2 class="text-center mb-5">システム統計</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">1,250+</div>
                        <div class="stat-label">登録生徒数</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">教師数</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">20+</div>
                        <div class="stat-label">開講コース数</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">満足度</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2 class="mb-4">今すぐ始める</h2>
            <p class="mb-4">効率的な学習管理を始めるために、今すぐログインしてください</p>
            <a href="{{ route('login') }}" class="cta-button">ログイン</a>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 クラス管理システム. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>