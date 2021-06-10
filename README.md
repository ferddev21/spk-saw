# Aplikasi Sistem Penunjang Keputusan Dinamis
aplikasi Penunjuang Keputusan yang dinamis, kriteria dan alternative dinamis sesuai dengan kebutuhan dengan metode Simple Additive Weighting.

Metode Simple Additive Weighting (SAW) dikenal dengan istilah metode penjumlahan terbobot. Konsep dasar pada metode SAW adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif di semua atribut. Metode SAW membutuhkan proses normalisasi matriks keputusan (X) ke suatu skala yang dapat diperbandingkan dengan semua rating alternatif yang ada. 

## Instalasi

1. clone github in your dir

```console
git clone https://github.com/ferddev21/spk-saw
```

2. buka direktori spk-saw

```console
cd spk-isp-saw
```

3. jalankan update composer

```console
composer update
```

4. ubah file name `.env.example` ke `.env` 

5. sesuaikan configurasi `.env` sesuai system pc anda

6. jalankan keygen baru

```console
php artisan key:generate
```

7. jalankan migrate database table

```console
php artisan migrate
```

8. run laravel serve

```console
php artisan serve
```

10. buka di url `http://127.0.0.1:8000`

11. Akan masuk ke halaman installasi, masukan nama aplikasi dan data users admin

Enjoy



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT) and Premium Bootstrap admin template from [BootstrapDash](https://www.bootstrapdash.com/).
