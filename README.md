# Laravel API — Kelas, Siswa, Kartu Pelajar

REST API sederhana untuk data sekolah dengan relasi:

- **Kelas (1) → Siswa (N)**: 1 kelas punya banyak siswa
- **Siswa (1) → Kartu Pelajar (1)**: 1 siswa punya 1 kartu pelajar

Stack: Laravel 13, PHP ^8.3, SQLite (default), Sanctum.

## 1. Prasyarat

- PHP >= 8.3 (`php -v`)
- Composer (`composer -V`)
- Git (opsional)

## 2. Instalasi & Menjalankan

```sh
# 1. Masuk ke folder project
cd laravelapi

# 2. Install dependency
composer install

# 3. Copy env (jika belum ada .env)
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Buat file SQLite jika belum ada (default DB_CONNECTION=sqlite)
touch database/database.sqlite

# 6. Migrasi + seeder (6 kelas, 50 siswa nama Indonesia, 50 kartu pelajar)
php artisan migrate:fresh --seed

# 7. Jalankan server
php artisan serve
# API tersedia di: http://localhost:8000/api
```

Perintah berguna lain:

```sh
# Migrasi saja
php artisan migrate

# Seeder saja (aman dijalankan berulang, pakai firstOrCreate / top-up 50)
php artisan db:seed

# Seeder per tabel
php artisan db:seed --class=KelasSeeder
php artisan db:seed --class=SiswaSeeder
php artisan db:seed --class=KartuPelajarSeeder

# Lihat daftar route API
php artisan route:list --path=api

# Jalankan test
php artisan test
```

## 3. Konfigurasi Database

Default memakai SQLite (`.env`):

```
DB_CONNECTION=sqlite
```

Untuk MySQL, ubah `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelapi
DB_USERNAME=root
DB_PASSWORD=
```

Lalu jalankan `php artisan migrate:fresh --seed`.

Faker locale untuk nama Indonesia:

```
APP_FAKER_LOCALE=id_ID
```

## 4. Daftar Endpoint

Base URL: `http://localhost:8000/api`

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/api/kelas` | List semua kelas + siswa + kartu |
| POST | `/api/kelas` | Buat kelas |
| GET | `/api/kelas/{id}` | Detail kelas |
| PUT/PATCH | `/api/kelas/{id}` | Update kelas |
| DELETE | `/api/kelas/{id}` | Hapus kelas |
| GET | `/api/siswa` | List semua siswa + kelas + kartu |
| POST | `/api/siswa` | Buat siswa |
| GET | `/api/siswa/{id}` | Detail siswa |
| PUT/PATCH | `/api/siswa/{id}` | Update siswa |
| DELETE | `/api/siswa/{id}` | Hapus siswa |
| GET | `/api/kartu-pelajar` | List semua kartu + siswa + kelas |
| POST | `/api/kartu-pelajar` | Buat kartu |
| GET | `/api/kartu-pelajar/{id}` | Detail kartu |
| PUT/PATCH | `/api/kartu-pelajar/{id}` | Update kartu |
| DELETE | `/api/kartu-pelajar/{id}` | Hapus kartu |

Dokumentasi lengkap tiap endpoint (parameter, body JSON, contoh response) ada di komentar atas file `routes/api.php`.

## 5. Contoh Request (cURL)

```sh
# List siswa
curl http://localhost:8000/api/siswa

# Buat kelas
curl -X POST http://localhost:8000/api/kelas \
  -H "Content-Type: application/json" \
  -d '{"nama_kelas":"X RPL 1"}'

# Buat siswa (id_kelas harus ada di tabel kelas)
curl -X POST http://localhost:8000/api/siswa \
  -H "Content-Type: application/json" \
  -d '{"nama":"Budi Santoso","id_kelas":1}'

# Buat kartu pelajar (id_siswa harus ada & belum punya kartu)
curl -X POST http://localhost:8000/api/kartu-pelajar \
  -H "Content-Type: application/json" \
  -d '{"nomor_kartu":"KP-2026-000001","id_siswa":1}'

# Update siswa
curl -X PUT http://localhost:8000/api/siswa/1 \
  -H "Content-Type: application/json" \
  -d '{"nama":"Budi Pratama"}'

# Hapus kartu
curl -X DELETE http://localhost:8000/api/kartu-pelajar/1
```

## 6. Validasi

**Kelas:** `nama_kelas` required, string, max 255.

**Siswa:** `nama` required string max 255, `id_kelas` required dan harus ada di `kelas.id`.

**Kartu Pelajar:** `nomor_kartu` required string max 255 unique, `id_siswa` required, harus ada di `siswas.id`, dan unique (1 siswa = 1 kartu).

## 7. Seeder (50 Data)

Seeder dijalankan urut via `DatabaseSeeder`:

1. `KelasSeeder` — 6 kelas tetap (`X RPL 1`, `X TKJ 1`, `XI RPL 1`, `XI TKJ 1`, `XII RPL 1`, `XII TKJ 1`) pakai `firstOrCreate`.
2. `SiswaSeeder` — top-up sampai 50 via `SiswaFactory` (nama Indonesia, `fake('id_ID')`).
3. `KartuPelajarSeeder` — 1 kartu per siswa yang belum punya kartu, format `KP-YYYY-XXXXXX` unique.

Factory: `database/factories/KelasFactory.php`, `SiswaFactory.php`, `KartuPelajarFactory.php`.

## 8. Troubleshooting

- `UNIQUE constraint failed: users.email` saat `db:seed` → sudah diperbaiki dengan `User::firstOrCreate()`. Tinggal jalankan `php artisan db:seed` ulang, tidak perlu fresh.
- `SQLSTATE ... database.sqlite ...` → pastikan file `database/database.sqlite` ada, lalu `php artisan migrate`.
- Validasi `id_kelas` / `id_siswa` gagal → pastikan id yang dikirim benar-benar ada (cek via GET list dulu).
