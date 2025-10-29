# LineFusion API Bootstrap

這是一個極簡 PHP 8.2 Web 框架骨架，目標是為後續導入 Laravel、Quasar 與 OpenAPI 流程建立乾淨的起點。第一步僅專注於「可啟動」與「可驗證」的 API/頁面。

## 需求
- PHP 8.2+
- Composer 2.x

## 安裝
```bash
composer install
cp .env.example .env
```

## 開發伺服器
```bash
composer serve
```
打開瀏覽器並造訪 [http://localhost:8000](http://localhost:8000)。

## API 文件（Swagger）
- Swagger UI：`GET /swagger`
- OpenAPI JSON：`GET /swagger.json`

## 健康檢查
- Web 首頁：`GET /`
- API Ping：`GET /api/ping`

## 專案結構重點
- `app/Core`：極簡 Application、Router 與 HTTP 輔助類別。
- `app/Http`：控制器層，示範 `HomeController`。
- `routes/web.php`：集中管理路由。
- `resources/views`：簡單樣板。
- `public/index.php`：進入點，與 Laravel 類似的 Bootstrap 流程。

後續可逐步替換為完整的 Laravel 11.x 與前端 Quasar SPA 架構。
