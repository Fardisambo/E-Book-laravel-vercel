# Activity Diagram untuk Admin

```
flowchart TD
    A[Start] --> B[Login sebagai Admin]
    B --> C[Lihat Dashboard]
    C --> D{Pilih Aksi}
    D -->|Kelola Kategori| E[Tambah/Edit/Hapus Kategori]
    D -->|Kelola Buku| F[Tambah/Edit/Hapus Buku]
    D -->|Kelola Peminjaman| G[Lihat/Update Peminjaman]
    D -->|Kelola Pengguna| H[Tambah/Edit/Hapus Pengguna]
    D -->|Kelola Pembelian| I[Lihat/Update Pembelian]
    D -->|Kelola Pembayaran| J[Lihat/Konfirmasi Pembayaran]
    E --> K[Simpan Perubahan]
    F --> K
    G --> K
    H --> K
    I --> K
    J --> K
    K --> C
    C --> L[Logout]
    L --> M[End]
```