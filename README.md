## TravelHub--登入系統說明

請使用以下指令將此專案clone到您的本地環境：
```bash
git clone https://github.com/Yang-012/TaiwanTravel.git
```
1.進入此專案：
```bash
cd TaiwanTravel
```

2.安裝 PHP 依賴：
```bash
composer install
```
3.開啟XAMPPT panel的mysql

4.設置環境檔案：
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

5.生成應用密鑰：
```bash
php artisan key:generate
```

6.運行數據庫遷移：
```bash
php artisan migrate
```

7.啟動伺服器(按crtl+c可停止)：
```bash
php artisan serve
```
##email登入設置說明(.env檔中自行設置)
```bash
MAIL_USERNAME=自己使用帳號
MAIL_PASSWORD=應用程式密碼
```
GOOGLE應用程式密碼設置說明：https://support.google.com/accounts/answer/185833?hl=zh-Hant


