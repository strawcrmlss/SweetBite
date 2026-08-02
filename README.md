# SweetBite

SweetBite merupakan aplikasi berbasis web yang dikembangkan menggunakan framework Laravel dengan menerapkan teknologi containerization menggunakan Docker. Aplikasi ini dirancang untuk membantu pengelolaan data produk, kategori, promosi, pesanan, serta pembayaran dalam satu sistem yang terintegrasi.

## Deskripsi Proyek

Proyek ini dibuat sebagai implementasi mata kuliah DevOps dengan tujuan mempelajari proses deployment aplikasi menggunakan Docker dan Docker Compose. Setiap layanan dijalankan pada container yang berbeda sehingga aplikasi lebih mudah dikembangkan, dijalankan, dan dipindahkan ke lingkungan lain tanpa memerlukan konfigurasi ulang yang kompleks.

## Teknologi yang Digunakan

- Laravel
- PHP 8.4 (PHP-FPM)
- MySQL 8.0
- Nginx
- Docker
- Docker Compose
- phpMyAdmin

## Struktur Proyek

```
SweetBite/
├── backend/              # Source code Laravel
├── nginx/                # Konfigurasi Nginx
├── Dockerfile            # Konfigurasi image aplikasi
├── compose.yaml          # Konfigurasi Docker Compose
├── struktur.txt
└── README.md
```

## Arsitektur Sistem

Aplikasi terdiri dari beberapa container yang saling terhubung melalui Docker Network.

- **Web Browser** sebagai client.
- **Nginx** sebagai web server.
- **Laravel (PHP-FPM)** sebagai backend aplikasi.
- **MySQL** sebagai database.
- **phpMyAdmin** sebagai media administrasi database.

## Cara Menjalankan Proyek

### 1. Clone Repository

```bash
git clone https://github.com/strawcrmlss/SweetBite.git
```

### 2. Masuk ke Folder Proyek

```bash
cd SweetBite
```

### 3. Build dan Jalankan Container

```bash
docker compose up -d --build
```

### 4. Mengakses Aplikasi

Aplikasi

```
http://localhost:8085
```

phpMyAdmin

```
http://localhost:8082
```

## Konfigurasi Database

```
DB_HOST=db
DB_PORT=3306
DB_DATABASE=sweetbite_db
DB_USERNAME=root
DB_PASSWORD=root
```

## Fitur Aplikasi

- Autentikasi Administrator
- Dashboard
- Manajemen Kategori
- Manajemen Produk
- Manajemen Promosi
- Manajemen Pesanan
- Pembayaran
- Laporan PDF

## Docker Services

| Service | Keterangan |
|----------|------------|
| app | Container Laravel (PHP-FPM) |
| webserver | Nginx Web Server |
| db | MySQL Database |
| phpmyadmin | Administrasi Database |

## Repository

Repository ini digunakan sebagai media version control selama proses pengembangan aplikasi menggunakan Git dan GitHub.