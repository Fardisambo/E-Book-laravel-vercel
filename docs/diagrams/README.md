# Diagram UML & Database - Laravel EbookStore

Folder ini berisi diagram UML (Draw.io) dan skema database (DBML) untuk proyek Laravel Ebook.

## Draw.io (UML)

1. Buka [draw.io](https://app.diagrams.net/) (diagrams.net) di browser, atau install Draw.io Desktop.
2. **File → Open from → Device** (atau drag-drop file `.drawio`).
3. Pilih file di folder `docs/diagrams/`.
4. **File → Export as** untuk simpan PNG/PDF/SVG.

| File | Deskripsi |
|------|-----------|
| **01-use-case-diagram.drawio** | Use Case Diagram: Actor (Guest, User, Admin) dan use case (Browse, Login, Purchase, Subscribe, Manage, dll.). |
| **02-activity-diagram-pembelian.drawio** | Activity Diagram: Alur pembelian buku (gratis/berbayar, keranjang, pembayaran, konfirmasi). |
| **03-erd-diagram.drawio** | ERD: Tabel dan relasi antar entitas. |

## dbdiagram.io (Database)

File **ebook.dbml** berisi skema database aplikasi dalam format **DBML** (Database Markup Language). Tabel bawaan Laravel (sessions, cache, jobs, password_reset_tokens) tidak disertakan.

### Cara pakai

1. Buka [dbdiagram.io](https://dbdiagram.io/).
2. Buat diagram baru atau **Import → Paste DBML**.
3. Salin isi file `docs/diagrams/ebook.dbml` dan paste ke editor.
4. Diagram ER akan ter-generate otomatis. Bisa export ke PDF/PNG dari menu.

### Tabel yang ada di ebook.dbml

- **users** – Pengguna (role: user/admin)
- **books** – Katalog ebook (price, file_path, dll.)
- **categories** – Kategori buku
- **book_category** – Pivot buku–kategori (many-to-many)
- **purchases** – Pembelian buku per user
- **subscriptions** – Langganan (monthly/yearly)
- **payment_methods** – Metode pembayaran (BCA, Dana, QRIS, dll.)
- **payments** – Pembayaran (polymorphic: Purchase/Subscription)
- **carts** – Keranjang (satu per user)
- **cart_items** – Item keranjang
- **bookmarks** – Bookmark halaman
- **reading_progress** – Progress baca
- **reviews** – Ulasan buku

Relasi polymorphic `payments.paymentable` (ke Purchase atau Subscription) tidak dinyatakan sebagai FK di DBML; di aplikasi di-handle oleh Eloquent `morphTo`.
