<p align="center">
  <img src="https://drive.google.com/uc?export=view&id=1npw4HmwWEIWhJp5NJ0_MtpUUMye3pWHL" width="400" alt="Logo Wino Bangunan">
</p>

## Tentang Wino Bangunan

Website ini merupakan company profile yang memperkenalkan perusahaan untuk menjangkau pelanggan lebih luas.

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
- buka *XAMPP* dan jalankan *Apache & MySQL*.
- Setelah itu, buat file baru *.env* dan pindahkan isi dari *.env.example* ke *.env* - Buka *.env* dan ganti nama *DB_DATABASE* pada *.env* menjadi *winobangunanweb*.
- Setelah itu, ketikkan *php artisan key:generate*.
- Kemudian, ketikkan *php artisan migrate*.
- Jika terdapat notif *The database 'winobangunanweb' does not exist on the 'mysql' connection. Would you like to create it? (yes/no)* maka tulis [yes]
- Setelah itu, ketikkan *php artisan db:seed --class=ProductSeeder* untuk memasukkan dummy data pada database
- Kemudian, jalankan *php artisan serve*.

4. Tampilan Mobile
- Jika anda ingin tampilan dalam bentuk mobile, anda perlu melakukan install extensions dan cari *Mobile Preview*
- Untuk menggunakan modal preview, pada keyboard, pencet tombol *CTRL+LSHIFT+P* dan pilih bagian *Mobile Preview: Show*