# Activity Diagram untuk Author

```
flowchart TD
    A[Start] --> B[Login sebagai Author]
    B --> C[Lihat Dashboard]
    C --> D{Pilih Aksi}
    D -->|Kelola Buku| E[Tambah/Edit/Hapus Buku]
    D -->|Lihat Peminjaman| F[Lihat Daftar Peminjaman]
    D -->|Kelola Metode Pembayaran| G[Tambah/Edit Metode Pembayaran]
    D -->|Lihat Pembayaran| H[Lihat Riwayat Pembayaran]
    E --> I[Simpan Perubahan]
    F --> J[Update Status Peminjaman]
    G --> K[Simpan Metode]
    H --> L[Konfirmasi Pembayaran]
    I --> C
    J --> C
    K --> C
    L --> C
    C --> M[Logout]
    M --> N[End]
```