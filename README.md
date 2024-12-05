## TravelHub--登入系統說明

請使用以下指令將此專案clone到您的本地環境：
```bash
git clone https://github.com/Yang-012/TaiwanTravel.git
```

進入此專案：
```bash
cd TaiwanTravel
```

安裝 PHP 依賴：
```bash
composer install
```

設置環境檔案：
創建並複製.env檔，同時在config/service.php中添加以下字句(第三方登入使用)
```bash
'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URL'),
    ],
    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => env('TWITTER_REDIRECT_URL'),
    ],
    'line' => [
        'client_id' => env('LINE_CLIENT_ID'), 
        'client_secret' => env('LINE_CLIENT_SECRET'), 
        'redirect' => env('LINE_REDIRECT_URL'), 
    ],
```

生成應用密鑰：
```bash
php artisan key:generate
```

運行數據庫遷移：
```bash
php artisan migrate
```
啟動伺服器(按crtl+c可停止)：
```bash
php artisan serve
```




