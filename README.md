# TravelHub
## laravel檔案引入說明

請使用以下指令將此專案clone到您的本地環境：
```bash
git clone https://github.com/Yang-012/TravelHub.git
```
1.進入此專案：
```bash
cd TravelHub
```

2.安裝 PHP 依賴：
```bash
composer install
```
3.開啟XAMPPT panel的mysql

4.設置環境檔案：
創建並複製我提供的.env檔

5.生成應用密鑰：
```bash
php artisan key:generate
```

6.重置資料庫(重新運行migration以重新創建資料表)：
```bash
php artisan migrate:fresh
```

7.啟動伺服器(按crtl+c可停止)：
```bash
php artisan serve
```
## email登入設置說明(.env檔中自行設置)
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587                            #伺服器使用的port(587對應tls)
MAIL_USERNAME=自己的GOOGLE帳號            #使用帳號
MAIL_PASSWORD=自己GOOGLE帳號的應用程式密碼 #應用程式密碼(非email密碼，見以下說明)
MAIL_ENCRYPTION=tls                      #加密方式
MAIL_FROM_ADDRESS=自己的GOOGLE帳號        #信件來源
MAIL_FROM_NAME="TaiwanHub"               #信件來源名稱
```
GOOGLE應用程式密碼設置說明：https://support.google.com/accounts/answer/185833?hl=zh-Hant

## 各頁面介紹

| 檔案位置                          | 功能描述                          |
|-----------------------------------|-----------------------------------|
| `view/layout/app.blade.php`       | 定義各頁面共通的模板，此頁面定義 `nav` 和 `footer` 放置 |
| `view/partials/navbar.blade.php`  | 放置 `layout` 使用的組件，此頁面為 `nav`       |
| `view/welcome.blade.php`          | 首頁                              |
| `view/dashboard.blade.php`        | 後台頁面                          |
| `view/emailsVerification.blade.php` | 信箱驗證信頁面                     |
| `view/verify-code.blade.php`      | 登入驗證碼輸入頁面                 |
| `view/login.blade.php`            | 登入頁面                          |

# 控制器介紹

| 檔案位置                     | 功能描述             |
|------------------------------|----------------------|
| `app/Http/SocialAuthController.php`  | 第三方登入           |


