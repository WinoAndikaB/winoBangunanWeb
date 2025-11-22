<div style="display:flex; justify-content:center;">
  <img src="images/lightmode-logo2.png" width="400">
</div>

## Tentang Wino Bangunan

Website ini merupakan company profile yang memperkenalkan peruusahaan untuk menjangkau pelanggan lebih luas

## Cara Menggunakan Website

1. Sebelum memulai langkah-langkahnya, siapkan kebutuhan software yaitu:

- XAMPP Control Panel : https://www.apachefriends.org/download.html
- Visual Studio Code : https://code.visualstudio.com/download
- Git : https://git-scm.com/downloads
- Composer : https://getcomposer.org/download/

2. . Download File
- Cari Folder tempat simpan projek, lalu, *Git Bash*.
- Setelah itu, jalankan *git clone https://github.com/WinoAndikaB/winoBangunanWeb.git*. atau
- Pada https://github.com/WinoAndikaB/winoBangunanWeb, buka dropdown "<>Code" lalu *Download Zip*.

3. Visual Studio Code
- Buka VSCode, kemudian buka *Terminal* pilih Bagian *Command Prompt (Jangan Powershell)*.
- Ketik *Composer Install*.
- Setelah itu, buat file baru *.env* dan pindahkan isi dari *.env.example* ke *.env*.
- Buka lagi Teriminal, *php artisan migrate --seed*.
- Setelah itu, ketikkan *php artisan key:generate*.
- Lalu, buka *XAMPP* dan jalankan *Apache & MySQL*.
- Kemudian, jalankan *php artisan serve*.