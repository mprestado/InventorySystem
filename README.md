# Houseware Inventory Management System

A modern, role-based inventory & point-of-sale system for a houseware shop, built with **Laravel 11**, **Tailwind CSS**, **Alpine.js**, and **Chart.js**, running on **XAMPP (PHP 8.2 + MariaDB/MySQL)**.

## Features

- **Dashboard** — KPI cards, sales & stock-movement charts, low/out-of-stock alerts, best sellers, recent activity, quick actions.
- **Products & Variants** — image, auto-generated SKU, barcode, category/brand/supplier/unit, cost & selling price, multiple variants each with their own SKU/barcode/stock/price.
- **Catalog** — Categories (with archive), Brands, Units, Suppliers, Customers.
- **Inventory** — Stock In, Stock Out (sale/damaged/expired/returned/internal), Inventory Adjustments (add/remove/correct) — all auto-update stock and write to an audit ledger.
- **Purchase Orders** — create, status workflow (pending → approved → ordered → partially received → completed → cancelled), receive items into inventory.
- **Point of Sale** — fast product grid, barcode scanning, cart, discount, tax, payment methods, printable receipt; stock auto-deducts.
- **Reports** — Sales, Inventory, Stock In/Out, Purchase Orders, Profit, Low Stock, Dead Stock, Fast Moving. Export to **PDF / Excel / CSV**.
- **Barcode & QR** — auto-generated per variant, printable label sheets.
- **Users & Roles** — Owner (full), Manager, Cashier, Inventory Staff — enforced via permissions.
- **Activity Logs** — every action logged with user, IP, and device.
- **Notifications** — low stock / out of stock alerts.
- **Settings & Backup** — shop info / tax / currency; database backup via mysqldump.
- **UI/UX** — responsive, dark/light mode, glassmorphism, toasts, confirmations, pagination.

## Requirements

- XAMPP with PHP 8.2+ and MySQL/MariaDB (Apache not required — uses `artisan serve`)
- The PHP `gd` extension enabled (already enabled during setup)
- Composer & Node (Node only needed if you later switch from the CDN assets)

## Setup (already done on this machine)

```bash
# 1. Database (MySQL must be running in XAMPP)
#    Database "houseware_inventory" is created and configured in .env

# 2. Install dependencies
composer install

# 3. Migrate and seed demo data
php artisan migrate:fresh --seed
```

## Running

Start MySQL in the **XAMPP Control Panel**, then from this folder:

```bash
php artisan serve
```

Open **http://127.0.0.1:8000**

### Demo accounts (password: `password`)

| Role            | Email                     | Access                                  |
|-----------------|---------------------------|-----------------------------------------|
| Owner           | owner@houseware.test      | Full access                             |
| Manager         | manager@houseware.test    | Inventory, reports, sales               |
| Cashier         | cashier@houseware.test    | POS / sales only                        |
| Inventory Staff | inventory@houseware.test  | Stock in / out / adjustments / products |

## Tech Notes

- **Sessions** use the `file` driver (reliable on this XAMPP/OneDrive setup).
- **Stock logic** lives in `app/Services/InventoryService.php` — every change writes a `stock_movements` ledger row and triggers low-stock notifications.
- **Numbering** (SKU, PO, invoice, references) is in `app/Support/NumberGenerator.php`.
- **Roles/permissions** seeded by `database/seeders/RolePermissionSeeder.php` (spatie/laravel-permission).
- Frontend uses Tailwind, Alpine, and Chart.js via CDN — no build step required.

## Database Backups

Backups (Admin → Backup) run `C:\xampp\mysql\bin\mysqldump.exe` and store `.sql` files in `storage/app/backups`.
