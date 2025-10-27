<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root {
            color-scheme: light dark;
            font-family: "Noto Sans TC", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top, #1a73e8, #0a192f);
            color: #f8fafc;
        }
        .card {
            background: rgba(15, 23, 42, 0.7);
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 15px 40px rgba(15, 23, 42, 0.4);
            max-width: 420px;
            text-align: center;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        p {
            line-height: 1.6;
        }
        code {
            background: rgba(148, 163, 184, 0.15);
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem;
            display: inline-block;
            color: #38bdf8;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></h1>
        <p>PHP 8.2 Ready 微型框架骨架</p>
        <p>API 健康檢查：<code>GET /api/ping</code></p>
        <p>啟動伺服器：<code>composer serve</code></p>
    </div>
</body>
</html>
