# Employee Remuneration Backend (Laravel)

## Arsitektur Solusi
Aplikasi ini menggunakan arsitektur RESTful API dengan Laravel sebagai backend. Berikut adalah alur data dari backend ke frontend:
1. **Frontend Request** : Frontend mengirimkan request HTTP ke backend (misalnya: POST untuk menambah data, GET untuk mengambil data).
2. **Backend Processing** : Backend menerima request, memproses data melalui controller, dan berinteraksi dengan database (Sqlite).
3. **Database Interaction** : Data disimpan atau diambil dari database.
4. **Response to Frontend** : Backend mengembalikan response dalam format JSON yang kemudian ditampilkan oleh frontend.

Diagram alur data:
> Frontend (Next.js) → [HTTP Request] → Backend (Laravel) → Database
>
> Frontend (Next.js) ← [JSON Response] ← Backend (Laravel) ← Database

## Penjelasan Desain
1. **Perhitungan Remunerasi** : Logika perhitungan remunerasi diintegrasikan ke dalam controller `EmployeeTaskController`. Perhitungan dilakukan berdasarkan rumus:
    
    `Total Remunerasi = (Jam Kerja × Tarif Per Jam) + Biaya Tambahan`
    
    Fungsi ini dirancang modular sehingga dapat digunakan baik untuk create maupun update data.

2. **Mass Assignment Protection** : Untuk mencegah modifikasi data yang tidak sah, Laravel menggunakan properti $fillable pada model untuk mengontrol kolom mana yang dapat dimodifikasi melalui mass assignment.

## Setup & Deploy
### Langkah-langkah Menjalankan Aplikasi Secara Lokal
1. Clone Repository
    ```bash
    git clone https://github.com/gunnery34/laravel-coding-challenge-aic

    cd laravel-coding-challenge-aic

    ```
2. Install Dependencies
    ```bash
    composer install
    ```
3. Konfigurasi Environment
    - Salin file `.env.example` menjadi `.env`:
        ```
        cp .env.example .env
        ```
    - Edit file `.env` untuk mengatur konfigurasi database:
        ```
        DB_CONNECTION=sqlite
        ````
4. Generate Application Key
    ```
    php artisan key:generate
    ```
5. Jalankan Migrasi Database
    ```
    php artisan migrate
    ```
6. Jalankan Server Lokal
    ```
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://localhost:8000`
7. Testing API
    - Gunakan Postman atau curl untuk menguji endpoint API:
        - GET `/api/tasks` → Mendapatkan semua data pekerjaan.
        - POST `/api/tasks` → Menambahkan data pekerjaan baru.
        - GET `/api/tasks/{id}` → Mendapatkan detail data pekerjaan berdasarkan ID.
        - PUT `/api/tasks/{id}` → Memperbarui data pekerjaan.
        - DELETE `/api/tasks/{id}` → Menghapus data pekerjaan.

### Deploy ke Production
1. Hosting Backend
    - Platform yang direkomendasikan: **Heroku**, **AWS**, **DigitalOcean**, atau **Laravel Forge**.
    - Pastikan environment production sudah dikonfigurasi dengan benar `(.env)`.
2. Setup Database
    - Gunakan database cloud seperti **Amazon RDS**, **Google Cloud SQL**, atau layanan hosting database lainnya.
3. Optimasi Aplikasi
    - Jalankan perintah berikut untuk optimasi
        ```
        php artisan config:cache
        php artisan route:cache
        php artisan view:cache
        ```


## Tantangan & Solusi
### Tantangan 1: Mass Assignment Error
- Masalah : Saat mencoba menambahkan data melalui API, muncul error `Add [employee_name] to fillable property`.
- Solusi : Menambahkan kolom-kolom yang ingin diizinkan ke properti `$fillable` di model `EmployeeTask`.

### Tantangan 2: Modularitas Logika Perhitungan
- **Masalah** : Logika perhitungan remunerasi awalnya tersebar di beberapa method, membuat kode kurang modular.
- **Solusi** : Refactor logika perhitungan ke fungsi terpisah (`calculateRemuneration`) di controller untuk meningkatkan reusability dan maintainability.

### Tantangan 3: Integrasi dengan Frontend
- **Masalah** : Frontend membutuhkan data dalam format JSON yang konsisten.
- **Solusi** : Memastikan semua response API mengembalikan data dalam format JSON yang sesuai dengan struktur yang diharapkan oleh frontend.