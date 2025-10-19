# LINE Fusion API

本專案為 **LINE 整合商務平台（LINE-integrated commerce platform）** 的後端服務，  
以 **Laravel 11** 為基礎建置，採用模組化架構，支援 **身分驗證、商品管理、訂單、金流、通知、後台管理** 等功能模組。  
此專案對應於系統架構文件（SA 文件）中的後端 API 部分。

## 系統需求（Requirements）

- PHP 8.2+
- Composer
- MySQL 8+
- Node.js 20+

## 專案啟動（Getting Started)

1. 複製環境設定檔:
   ```bash
   cp .env.example .env
   ```
2. 安裝 PHP 套件依賴:
   ```bash
   composer install
   ```
3. 產生 Laravel 應用程式金鑰:
   ```bash
   php artisan key:generate
   ```
4. 設定 .env 中的資料庫連線資訊，並執行資料表遷移:
   ```bash
   php artisan migrate
   ```
5. 安裝前端工具依賴並編譯資產檔案:
   ```bash
   npm install
   npm run dev
   ```

## 測試執行（Testing）

Run the automated test suite with:
```bash
php artisan test
```
