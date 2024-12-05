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
創建並複製我提供的.env檔

5.生成應用密鑰：
```bash
php artisan key:generate
```

6.重置資料庫(重新運行所有遷移檔案以重新創建資料表)：
```bash
php artisan migrate:fresh
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


