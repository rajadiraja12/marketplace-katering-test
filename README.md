# Marketplace Katering

Aplikasi web untuk menghubungkan **perusahaan katering (Merchant)** dengan **kantor (Customer)** dalam pemesanan makan karyawan.

Dibuat dengan **Laravel 8** + **MySQL** + **Tailwind CSS**.

---

## Fitur

**Merchant:**
- Registrasi, login, kelola profil katering
- CRUD menu (nama, deskripsi, foto, harga)
- Lihat & kelola order masuk
- Download invoice

**Customer:**
- Registrasi, login
- Cari katering (filter lokasi & menu)
- Pesan menu (pilih porsi & tanggal kirim)
- Lihat riwayat pesanan & Download invoice

---

## Instalasi

```bash
# 1. Clone
git clone https://github.com/rajadiraja12/marketplace-katering-test.git
cd marketplace-katering-test

# 2. Install dependency
composer install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Buat database "katering" di MySQL,
#    lalu sesuaikan .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 5. Migrasi & seeder
php artisan migrate

# 6. Storage link
php artisan storage:link

# 7. Jalankan
php artisan serve"# marketplace-katering-test" 
