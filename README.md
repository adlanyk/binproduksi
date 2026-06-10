<div align="center">

# 🏠 Bin Tracker

### *"Monitoring barangmu di gudang"*

[![PHP](https://img.shields.io/badge/PHP-8.1-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![Status](https://img.shields.io/badge/status-production-brightgreen?style=flat-square)]()

**Bin Management System** — Catat barang masuk/keluar gudang, cek status bin dalam 1 detik.

</div>

---

## 📦 Ini tuh apa?

Bayangin kamu punya gudang dengan **100 rak**. Setiap rak bisa berisi barang atau kosong.  
Nah, sistem ini bantu kamu:

| Masalah | Solusi |
|---------|--------|
| "Rak A1 isinya apa ya?" | Lihat `currentItem` |
| "Rak mana aja yang masih kosong?" | Cek `isFilled` = false |
| "Siapa yang terakhir masukin barang?" | Tracking via `created_at` |

> 💡 **Intinya:** Bikin inventory gak berantakan.

---


## 🚀 Quick Install

---

# Clone
git clone https://github.com/username/bin-tracker.git
cd bin-tracker

# Install
composer install
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate

# Selesai!
php artisan serve

---
