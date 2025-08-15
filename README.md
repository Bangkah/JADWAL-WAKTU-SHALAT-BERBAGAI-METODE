# Jadwal Waktu Shalat Bulanan

Aplikasi web ini menampilkan **jadwal shalat bulanan** secara **dinamis** berdasarkan posisi geografis pengguna (latitude & longitude) dan metode perhitungan yang dipilih. Data shalat dihitung menggunakan **PrayTimes.js** sehingga tidak bergantung pada API eksternal.

## Demo
<img width="1384" height="829" alt="image" src="https://github.com/user-attachments/assets/9af6a39f-5251-414e-98c0-75a597d755f7" />

---

## Fitur

- Menampilkan **jadwal shalat bulanan**: Subuh, Dzuhur, Ashar, Maghrib, Isya.  
- Menentukan jadwal berdasarkan **latitude, longitude, dan timezone** pengguna.  
- Mendukung beberapa **metode perhitungan**:
  - Depag RI
  - ISRN
  - Muhammadiyah
  - MWL (Muslim World League)
  - ISNA
  - Egyptian General Authority of Survey
  - Umm al-Qura University, Makkah
  - University of Islamic Sciences, Karachi
  - Shia Ithna-Ashari (Jafari)
  - Institute of Geophysics, University of Tehran
- **Highlight hari ini** di tabel.  
- Menampilkan **tanggal Masehi, dan Hijriah,**.  
- Tampilan modern dengan **CSS rapi** dan **tabel responsif**.

---

## Cara Penggunaan

1. **Clone atau download** repository ini:
   ```bash
   git clone https://github.com/Bangkah/JADWAL-WAKTU-SHALAT-BERBAGAI-METODE.git

    Buka file index.html di browser.

    Masukkan latitude, longitude, dan timezone lokasi Anda.

    Pilih metode perhitungan yang diinginkan dari dropdown.

    Navigasikan antara bulan menggunakan tombol << dan >>.

    Tabel akan menampilkan jadwal shalat lengkap untuk setiap hari.

Struktur Folder

jadwal-shalat-bulanan/
│
├─ index.html          # Halaman utama dengan tabel dan form input
├─ PrayTimes.js        # Library JavaScript untuk perhitungan waktu shalat
├─ README.md           # Dokumentasi proyek

Konfigurasi

    Latitude & Longitude: Tentukan posisi lokasi Anda.

    Time Zone: Zona waktu lokal (misal: 7 untuk WIB).

    DST: Pilih Auto / 0 / 1 sesuai kebutuhan.

    Method: Pilih metode perhitungan shalat.

    Semua perhitungan dilakukan di sisi klien (browser), sehingga aplikasi tidak membutuhkan server atau API eksternal.

Tampilan

    Tabel modern dengan highlight hari ini.

    Form input rapi menggunakan flexbox.

    Warna lembut, rounded corner, dan shadow pada tabel & fieldset.

Lisensi

Proyek ini dibuat untuk edukasi & penggunaan pribadi.
Silakan gunakan dan modifikasi sesuai kebutuhapenggunaan pribadi.
Silakan gunakan dan modifikasi sesuai kebutuhan
