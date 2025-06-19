Step-step jalanin aplikasi

1. install terlebih dahulu composer, node.js, dan web server (mamp untuk macOS atau laragon untuk Windows)
2. clone atau download project
3. buka folder project lalu buka terminal dan jalankan "composer install" dan "npm install"
4. buat file .env dari env.example kemudian konfigurasi setup database
5. buka terminal kemudian jalankan "php artisan migrate"
6. kemudian jalankan "php artisan db:seed"
7. kemudian jalankan "php artisan key:generate"
8. kemudian jalankan "php artisan link:storage"
9. kemudian jalankan aplikasi dengan "php artisan serve" kemudian buka terminal kedua dan jalankan "npm run dev"

login page : 127.0.0.1/admin/login

email : admin@tes.com
pass : password
