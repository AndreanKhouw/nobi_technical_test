###########READ ME############
Anda akan menerima projek ini dalam bentuk zip.

Step 1 :
1.1, Download lah terlebih dahulu XAMPP pada web (https://www.apachefriends.org/download.html)
1.2, Pilih lah xampp dengan versi PHP 8 sesuai dengan OS yang anda gunakan.

Step 2 :
2.1 Setelah selesai mendownload xampp, buka halaman browser anda.
2.2 Nyalah kan Mysql dengan cara menekan tombol start pada Mysql.
2.3 Akses link berikut "localhost/phpmyadmin"
2.4 tekan New/Buat Baru. dan masukkan "nobi_tech_test" pada database name.
2.5 klik menu import yang ada pada menu atas layar anda.
2.6 klik tombol Choose File.
2.7 pilih File "nobi_tech_test.sql" yang ada pada folder projek
2.8 Scroll kebawah maka anda akan menemukan tombol go. klik tombol go dan database akan terimport.

Step 3:
3.1, Setelah selesai mendownload xampp pindahkan/unzip projek ini pada folder xampp->htdocs sesuai lokasi xampp yang sudah anda install.
3.2, Buka applikasi xampp yang sudah anda install, dan tekan tombol start pada bagian apache dan mysql.
3.3, Buka Command Promp anda dan arahkan command promp anda ke folder projek ini.
3.4, Jalan kan command berikut : composer install.
3.5 Jika Ada settingan port berbeda untuk mysql pada device anda, anda dapat mengubah port atau settingan lain nya pada  file .env
3.6, Jika sudah selesai anda akan dapat mencoba menjalankan projek ini melalui browser anda dengan cara "localhost/{folder_project_ini}/public" jika sudah muncul halaman laravel maka projek ini sudah siap digunakan.

Step 3:
3.1, Pada folder projek ini sudah saya siapkan file postman collection untuk mencoba api-api yang dibuat, dengan nama file "nobi_technical_test_collection.json".
3.2, Anda dapat mendownload terlebih dahulu applikasi postman terbaru melalui link berikut https://www.postman.com/downloads/
3.3, Setelah sudah selesai terdownload anda dapat langsung menginstall applikasi postman sesuai dengan keinginan anda.
3.4, Setelah applikasi postman sudah selesai terinstall di device anda, anda dapat mengimport file collection tadi ke applikasi postman anda dengan cara click tombol "import" pada sidebar kiri anda kemudian pada bagian file pilih file collection yang sudah saya siapkan pada folder projek ini.
