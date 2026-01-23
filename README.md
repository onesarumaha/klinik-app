Cara instalasi :

Clone repository menggunakan perintah git clone https://github.com/onesarumaha/klinik-app.git

Masuk ke direktori project lalu buat branch baru dengan perintah git checkout -b nama-branch

Install seluruh dependency Laravel menggunakan perintah composer install

Salin file environment dengan menyalin .env.example menjadi .env menggunakan perintah cp .env.example .env

Generate application key Laravel menggunakan perintah php artisan key:generate

Install Laravel Breeze sebagai sistem autentikasi dengan perintah composer require laravel/breeze --dev

Jalankan proses instalasi Breeze dengan perintah php artisan breeze:install dan pilih stack Blade

Install dependency frontend menggunakan perintah npm install

Build asset frontend menggunakan perintah npm run build

Jalankan frontend dalam mode development menggunakan perintah npm run dev

Jalankan migrasi database menggunakan perintah php artisan migrate

Jalankan aplikasi Laravel menggunakan perintah php artisan serve

selesai
