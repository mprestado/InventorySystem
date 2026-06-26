# 🏠 Houseware Inventory Management System

A modern, role-based **inventory & point-of-sale (POS) system** for a houseware shop — built with **Laravel 11**, **Tailwind CSS**, **Alpine.js**, and **Chart.js**, running on **PHP 8.2+** with **MySQL / MariaDB**.

<p align="left">
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel&logoColor=white">
  <img alt="PHP" src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white">
  <img alt="MySQL" src="https://img.shields.io/badge/MySQL%2FMariaDB-DB-4479A1?logo=mysql&logoColor=white">
  <img alt="License" src="https://img.shields.io/badge/License-MIT-green">
</p>

---

## ✨ Features

- **Dashboard** — KPI cards, sales & stock-movement charts, low/out-of-stock alerts, best sellers, recent activity, quick actions.
- **Products & Variants** — image, auto-generated SKU, barcode, category/brand/supplier/unit, cost & selling price, and multiple variants each with their own SKU/barcode/stock/price.
- **Catalog** — Categories (with archive), Brands, Units, Suppliers, Customers.
- **Inventory** — Stock In, Stock Out (sale/damaged/expired/returned/internal), and Inventory Adjustments (add/remove/correct) — all auto-update stock and write to an audit ledger.
- **Purchase Orders** — create, status workflow (pending → approved → ordered → partially received → completed → cancelled), and receive items into inventory.
- **Point of Sale** — fast product grid, barcode scanning, cart, discount, tax, payment methods, and printable receipt; stock auto-deducts.
- **Reports** — Sales, Inventory, Stock In/Out, Purchase Orders, Profit, Low Stock, Dead Stock, Fast Moving. Export to **PDF / Excel / CSV**.
- **Barcode & QR** — auto-generated per variant, printable label sheets.
- **Users & Roles** — Owner (full), Manager, Cashier, Inventory Staff — enforced via permissions.
- **Activity Logs** — every action logged with user, IP, and device.
- **Notifications** — low stock / out of stock alerts.
- **Settings & Backup** — shop info / tax / currency; database backup via `mysqldump`.
- **UI/UX** — responsive, dark/light mode, glassmorphism, toasts, confirmations, pagination.

---

## 🧰 Tech Stack

| Layer        | Technology                                                        |
|--------------|-------------------------------------------------------------------|
| Backend      | Laravel 11, PHP 8.2+                                               |
| Database     | MySQL / MariaDB (XAMPP recommended on Windows)                     |
| Frontend     | Blade, Tailwind CSS, Alpine.js, Chart.js (via CDN — no build step) |
| Auth/Roles   | spatie/laravel-permission                                         |
| PDF / Excel  | barryvdh/laravel-dompdf, maatwebsite/excel                        |
| Barcode / QR | milon/barcode, simplesoftwareio/simple-qrcode                     |

See [`requirements.txt`](requirements.txt) for the full list of prerequisites and dependencies.

---

## ✅ Requirements

- **PHP 8.2+** with extensions: `gd`, `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `curl`, `zip`
- **Composer 2.x**
- **MySQL 8+** or **MariaDB 10.4+** (e.g. via XAMPP)
- **Node.js 18+** & npm — *only* needed if you switch from the CDN assets to a Vite build

> On Windows, **XAMPP** bundles PHP + MySQL together and is the easiest way to get going.

---

## 🚀 Getting Started

```bash
# 1. Clone the repository
git clone https://github.com/Drin5/InventorySystem.git
cd InventorySystem

# 2. Install PHP dependencies
composer install

# 3. Create your environment file
cp .env.example .env        # Windows: copy .env.example .env
php artisan key:generate
```

### Configure the database

Create a database (e.g. `houseware_inventory`) in phpMyAdmin / MySQL, then edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=houseware_inventory
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
```

### Migrate & seed demo data

```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

### Run the app

Start MySQL (e.g. in the **XAMPP Control Panel**), then:

```bash
php artisan serve
```

Open **http://127.0.0.1:8000** 🎉

---

## 👥 Demo Accounts

Password for all accounts: `password`

| Role            | Email                     | Access                                  |
|-----------------|---------------------------|-----------------------------------------|
| Owner           | owner@houseware.test      | Full access                             |
| Manager         | manager@houseware.test    | Inventory, reports, sales               |
| Cashier         | cashier@houseware.test    | POS / sales only                        |
| Inventory Staff | inventory@houseware.test  | Stock in / out / adjustments / products |

---

## 📁 Project Structure

```
app/
  Http/Controllers/   # Products, POS, Sales, PO, Reports, Users, Settings, Backup…
  Models/             # Eloquent models
  Services/           # InventoryService — core stock logic + ledger
  Support/            # NumberGenerator — SKU / PO / invoice numbering
  Exports/            # Excel/CSV export classes
database/
  migrations/         # Schema
  seeders/            # RolePermissionSeeder + demo data
resources/views/      # Blade templates (Tailwind + Alpine)
routes/web.php        # Application routes
storage/app/backups/  # Generated .sql database backups
```

---

## 🛠️ Tech Notes

- **Sessions** use the `file` driver (reliable on XAMPP / OneDrive setups).
- **Stock logic** lives in `app/Services/InventoryService.php` — every change writes a `stock_movements` ledger row and triggers low-stock notifications.
- **Numbering** (SKU, PO, invoice, references) is in `app/Support/NumberGenerator.php`.
- **Roles/permissions** are seeded by `database/seeders/RolePermissionSeeder.php` (spatie/laravel-permission).
- **Frontend** uses Tailwind, Alpine, and Chart.js via CDN — no build step required.

---

## 💾 Database Backups

Backups (**Admin → Backup**) run `mysqldump` (on Windows: `C:\xampp\mysql\bin\mysqldump.exe`) and store timestamped `.sql` files in `storage/app/backups`.

---

## 📄 License

Released under the **MIT License**.
