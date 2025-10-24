# LINE Fusion API

此專案提供 LINE 整合商務平台的後端服務，對應系統架構設計文件所描述的需求。
整體以 Laravel 11 為基礎啟動，並依模組化架構劃分登入驗證、商品、訂單、金流、通知與後台等功能領域，方便後續擴充與維護。

## 系統需求

- PHP 8.2 以上版本
- Composer
- MySQL 8 以上版本
- Node.js 20 以上版本

## 快速開始

1. 複製環境變數設定檔：
   ```bash
   cp .env.example .env
   ```
2. 安裝 PHP 相依套件：
   ```bash
   composer install
   ```
3. 產生應用程式金鑰：
   ```bash
   php artisan key:generate
   ```
4. 於 `.env` 設定資料庫連線後執行資料庫遷移：
   ```bash
   php artisan migrate
   ```
5. 安裝前端建置工具並編譯資產：
   ```bash
   npm install
   npm run dev
   ```

## 測試

執行自動化測試流程：
```bash
php artisan test
```
