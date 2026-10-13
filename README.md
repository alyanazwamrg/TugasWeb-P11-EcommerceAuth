# Tugas Rutin 11 – E-Commerce DB + Secure Auth (Laravel)

Aplikasi e-commerce sederhana dengan database relasional, autentikasi Laravel Breeze, multi-role (admin / editor / user), custom middleware, dan otorisasi dengan Policy.

## Fitur
- 7 tabel e-commerce dengan foreign key: users, categories, products, orders, order_items, tags, product_tag
- Seeder + factory (54 produk realistis, 6 kategori, 5 tag, pesanan contoh)
- Model dengan relationships dan scope (`published`, `inStock`)
- Login, register, logout (Laravel Breeze)
- Multi-role dengan custom middleware `CheckRole` (`role:admin`)
- CRUD produk dengan eager loading dan validasi
- Otorisasi dengan `ProductPolicy`

## Cara menjalankan
1. `composer install`
2. Salin `.env.example` menjadi `.env`, lalu atur database (`DB_DATABASE=ecommerce_auth`, MySQL)
3. `php artisan key:generate`
4. Buat database `ecommerce_auth` di MySQL
5. `php artisan migrate:fresh --seed`
6. `npm install`
7. Terminal 1: `npm run dev`
8. Terminal 2: `php artisan serve`
9. Buka `http://127.0.0.1:8000`

## Akun testing (password: `password`)
| Role | Email |
|---|---|
| admin | admin@example.com |
| editor | editor@example.com |
| user | user@example.com |

## Aturan akses
- **admin**: akses `/admin`, bisa mengedit dan menghapus semua produk
- **editor**: bisa menambah produk, mengedit dan menghapus hanya produk miliknya
- **user**: hanya bisa melihat daftar produk

## Catatan
Tugas menyebut `PostPolicy`. Karena entitas utama aplikasi ini adalah produk, otorisasi edit/delete diimplementasikan sebagai `ProductPolicy` dengan logika yang sama.

## Dokumentasi
Screenshot ada di folder `docs/` (query Tinker, Breeze, tes role, dan tes policy).
### Query Tinker
![Tinker 1](docs/tinker-1.png)
![Tinker 2](docs/tinker-2.png)
![Tinker 3](docs/tinker-3.png)
![Tinker 4](docs/tinker-4.png)
![Tinker 5](docs/tinker-5.png)

### Breeze (login, register, dashboard, logout)
![Login](docs/breeze-login.png)
![Register](docs/breeze-register.png)
![Dashboard](docs/breeze-dashboard.png)
![Logout](docs/breeze-logout.png)

### Tes role dan middleware
![Admin](docs/role-admin.png)
![User dashboard](docs/role-user-dashboard.png)
![User 403](docs/role-user-403.png)

### Tes policy
![Produk admin](docs/products-admin.png)
![Produk user](docs/products-user.png)
![Produk editor](docs/products-editor.png)
![User tambah produk 403](docs/policy-user-create-403.png)
![Editor edit produk sendiri](docs/policy-editor-own.png)
![Editor edit produk orang lain 403](docs/policy-editor-other-403.png)
![Belum login diarahkan ke login](docs/policy-guest-login.png)