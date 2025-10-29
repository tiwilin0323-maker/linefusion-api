<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5.11.7/swagger-ui.css">
    <style>
        body { margin: 0; background: #0f172a; color: #e2e8f0; }
        .topbar { display: none; }
        #swagger-ui { margin: 0 auto; }
    </style>
</head>
<body>
<div id="swagger-ui"></div>
<script src="https://unpkg.com/swagger-ui-dist@5.11.7/swagger-ui-bundle.js"></script>
<script>
    window.onload = function () {
        window.ui = SwaggerUIBundle({
            url: '<?= htmlspecialchars($specUrl, ENT_QUOTES, 'UTF-8') ?>',
            dom_id: '#swagger-ui',
            layout: 'BaseLayout',
            deepLinking: <?= $deepLinking ? 'true' : 'false' ?>,
        });
    };
</script>
</body>
</html>
