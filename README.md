# Sistem Manajemen Surat

Sistem manajemen surat adalah aplikasi berbasis web untuk mengelola surat masuk dan surat keluar dengan fitur tracking status surat.

## Persyaratan Sistem

-   PHP >= 8.1
-   Composer
-   MySQL/MariaDB
-   Node.js & NPM
-   Git

## Cara Instalasi

1. Clone repository ini
   git clone <url-repository>
   cd <nama-folder>
2. composer install
3. npm install
4. Salin file .env.example menjadi .env

5. Generate application key
6. Konfigurasi database di file .env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username
   DB_PASSWORD=
   7.php artisan migrate --seed
7. php artisan storage:link
8. composer require barryvdh/laravel-dompdf

9. php artisan serve dan npm run dev

## Package yang Digunakan

-   barryvdh/laravel-dompdf - Untuk generate PDF
-   DataTables - Untuk tabel interaktif
