# Activity Diagram untuk Regular User

```
flowchart TD
    A[Start] --> B{Login/Register}
    B -->|Register| C[Isi Form Registrasi]
    B -->|Login| D[Masuk dengan Email/Password]
    C --> E[Berhasil Register]
    D --> E
    E --> F[Browse/Search Buku]
    F --> G[Lihat Detail Buku]
    G --> H{Pilih Aksi}
    H -->|Pinjam| I[Pinjam Buku]
    H -->|Beli| J[Beli Buku]
    H -->|Baca| K[Baca Buku Online]
    I --> L[Konfirmasi Peminjaman]
    J --> M[Proses Pembayaran]
    K --> N[Selesai Membaca]
    L --> O[Lihat Daftar Peminjaman]
    M --> P[Lihat Status Pembayaran]
    O --> Q[Kelola Profil]
    P --> Q
    N --> Q
    Q --> R[Logout]
    R --> S[End]
```