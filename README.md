
| Nama                    | NIM        | Kelas   | Matkul            |
|-------------------------|------------|---------|-------------------|
| Muhammad Rizqy | 312310415  | TI.23.A4| Pemrograman Web 2 |


Praktikum 1 - 6
1. Untuk mengaktifkan ekstentsi tersebut, melalu XAMPP Control Panel, pada bagian Apache
klik Config -> PHP.ini

![image](https://github.com/user-attachments/assets/b1ccb9f3-523f-4805-883b-5ef294cc4eef)


2. Pada bagian extention, hilangkan tanda ; (titik koma) pada ekstensi yang akan diaktifkan.
Kemudian simpan kembali filenya dan restart Apache web server.

![Screenshot 2025-03-21 124027](https://github.com/user-attachments/assets/3fe5a173-86da-4403-a2c7-a197062a1ba8)

3. Instalasi Codeigniter 4
Untuk melakukan instalasi Codeigniter 4 dapat dilakukan dengan dua cara, yaitu cara manual
dan menggunakan composer.

![image](https://github.com/user-attachments/assets/a616f290-01ea-42a8-b939-1b077e20379f)

4. Menjalankan CLI (Command Line Interface)
Codeigniter 4 menyediakan CLI untuk mempermudah proses development. Untuk mengakses
CLI buka terminal/command prompt.

![image](https://github.com/user-attachments/assets/da7a0dbf-9117-465c-9889-1279681a5648)

Arahkan lokasi direktori sesuai dengan direktori kerja project dibuat
(xampp/htdocs/lab11_ci/ci4/)

5. Perintah yang dapat dijalankan untuk memanggil CLI Codeigniter adalah:
   **PHP SPARK**

![image](https://github.com/user-attachments/assets/8b4d6c2b-7e0f-4829-8d14-3f952bb72307)

6. Mengaktifkan Mode Debugging
Codeigniter 4 menyediakan fitur debugging untuk memudahkan developer untuk mengetahui
pesan error apabila terjadi kesalahan dalam membuat kode program.
Secara default fitur ini belum aktif. Ketika terjadi error pada aplikasi akan ditampilkan pesan
kesalahan seperti berikut.

![image](https://github.com/user-attachments/assets/b5e6e606-9b78-424b-8cf1-edb1b6f72e0f)

7. Semua jenis error akan ditampilkan sama. Untuk memudahkan mengetahui jenis errornya,
maka perlu diaktifkan mode debugging dengan mengubah nilai konfigurasi pada environment
variable CI_ENVIRINMENT menjadi development.

![image](https://github.com/user-attachments/assets/4ae40147-e188-46e9-b14b-ffd0e33eed01)

Ubah nama file env menjadi .env kemudian buka file tersebut dan ubah nilai variable
CI_ENVIRINMENT menjadi development.

![image](https://github.com/user-attachments/assets/457e7a6a-474d-4f59-8208-f1bc1cdb33be)

Contoh error yang terjadi. Untuk mencoba error tersebut, ubah kode pada file
app/Controller/Home.php hilangkan titik koma pada akhir kode.

![image](https://github.com/user-attachments/assets/ed11d490-dc4f-431f-8d8e-ce1fd94dce35)

8. Pada Codeigniter, request yang diterima oleh file index.php akan diarahkan ke Router untuk
meudian oleh router tesebut diarahkan ke Controller.
Router terletak pada file **app/config/Routes.php**

![image](https://github.com/user-attachments/assets/d4492232-bce8-43f8-a232-fce17fdce80f)

9. Membuat Route Baru.
Tambahkan kode berikut di dalam **Routes.php**

$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

![image](https://github.com/user-attachments/assets/e0df964a-7992-4fa7-964f-61993655aab0)

Untuk mengetahui route yang ditambahkan sudah benar, buka CLI dan jalankan perintah
berikut.

![image](https://github.com/user-attachments/assets/5c07fc9e-65dc-46af-8891-10742ae7581d)

Selanjutnya coba akses route yang telah dibuat dengan mengakses alamat url
http://localhost:8080/about

![Screenshot 2025-03-21 131531](https://github.com/user-attachments/assets/2f3edd4f-6569-43a8-9800-b6273c99b5bc)

Ketika diakses akan mucul tampilan error 404 file not found, itu artinya file/page tersebut tidak
ada. Untuk dapat mengakses halaman tersebut, harus dibuat terlebih dahulu Contoller yang
sesuai dengan routing yang dibuat yaitu Contoller Page.

10. Membuat Controller
Selanjutnya adalah membuat Controller Page. Buat file baru dengan nama **page.php** pada
direktori Controller kemudian isi kodenya seperti berikut.

![image](https://github.com/user-attachments/assets/c299574b-ce23-460a-a56d-3db282e82ac3)

Selanjutnya refresh Kembali browser, maka akan ditampilkan hasilnya yaotu halaman sudah
dapat diakses.

![Screenshot 2025-03-21 132900](https://github.com/user-attachments/assets/3f5987fd-8fe8-4cf8-8a19-e067cc3fef12)

11. Auto Routing
Secara default fitur autoroute pada Codeiginiter sudah aktif. Untuk mengubah status autoroute
dapat mengubah nilai variabelnya. Untuk menonaktifkan ubah nilai true menjadi false.

Method ini belum ada pada routing, sehingga cara mengaksesnya dengan menggunakan
alamat: http://localhost:8080/page/tos

![image](https://github.com/user-attachments/assets/31cf84ba-697f-443b-87e3-dd2789cc8637)

12. Membuat View
Selanjutnya dalam membuat view untuk tampilan web agar lebih menarik. Buat file baru
dengan nama **about.php** pada direktori view **(app/view/about.php)** kemudian isi kodenya
seperti berikut.

![image](https://github.com/user-attachments/assets/daff301b-6d8d-4be0-a055-325edffa0e96)

Ubah method about pada class Controller Page menjadi seperti berikut:

<img width="627" alt="image" src="https://github.com/user-attachments/assets/9d95d4ac-d564-4f7e-a5a0-3434f6ea8e52" />

Kemudian lakukan refresh pada halaman tersebut.

![image](https://github.com/user-attachments/assets/b285993b-bf83-449c-a4d4-e283d25cb86c)

13. Membuat Layout Web dengan CSS
Pada dasarnya layout web dengan css dapat diimplamentasikan dengan mudah pada
codeigniter. Yang perlu diketahui adalah, pada Codeigniter 4 file yang menyimpan asset css
dan javascript terletak pada direktori public.
Buat file css pada direktori public dengan nama style.css

![image](https://github.com/user-attachments/assets/d4099607-3343-4ae5-b1e7-c972aed2c39b)

Kemudian buat folder template pada direktori view kemudian buat file **header.php**h dan
**footer.php**

![image](https://github.com/user-attachments/assets/3fb3cbc9-7f2f-4e8f-bbec-7a1abcc84c65)

File **app/view/template/footer.php**

![Screenshot 2025-03-21 134623](https://github.com/user-attachments/assets/ec607eeb-4662-459a-b9cb-64b2fe96b717)

Kemudian ubah file **app/view/about.php** seperti berikut.

![image](https://github.com/user-attachments/assets/cd5c4862-8a4b-4fab-a187-83a853bfbc5b)

Selanjutnya refresh tampilan pada alamat http://localhost:8080/about

![image](https://github.com/user-attachments/assets/4c8eb14e-a444-4324-9883-509174cc72ee)

14. Membuat database di my sql dengan nama lab_ci4

![image](https://github.com/user-attachments/assets/9eb909fb-33ef-4c69-ae6c-4359e2a0e332)

setelah membuat data base, lalu membuat tablenya dengan nama artikel

![image](https://github.com/user-attachments/assets/b20b1606-c8c0-420a-a778-1812ae5b2cc7)

15. Konfigurasi koneksi database
Selanjutnya membuat konfigurasi untuk menghubungkan dengan database server. Konfigurasi
dapat dilakukan dengan du acara, yaitu pada file **app/config/database.php** atau menggunakan
file **.env.** Pada praktikum ini kita gunakan konfigurasi pada file **.env.**

![image](https://github.com/user-attachments/assets/298f0c1b-66c5-4285-9f2e-1f6380750355)

16. Membuat Model
Selanjutnya adalah membuat Model untuk memproses data Artikel. Buat file baru pada
direktori app/Models dengan nama **ArtikelModel.php

![image](https://github.com/user-attachments/assets/50b97124-a21c-4b39-b0bd-a11d053fbaba)

17. Membuat Controller
Buat Controller baru dengan nama **Artikel.php** pada direktori app/Controllers.

![image](https://github.com/user-attachments/assets/898d6d00-d37a-4437-b348-2320f0c9e88c)

18. Membuat View
Buat direktori baru dengan nama artikel pada direktori app/views, kemudian buat file baru
dengan nama **index.php.**

![image](https://github.com/user-attachments/assets/daac512a-cc9f-4006-9f8a-d8381b91b38e)

Selanjutnya buka browser kembali, dengan mengakses url http://localhost:8080/artikel

![image](https://github.com/user-attachments/assets/2095cbd0-8697-4dce-8fa2-9ec28b9d4663)

Belum ada data yang diampilkan. Kemudian coba tambahkan beberapa data pada database agar
dapat ditampilkan datanya.

**INSERT INTO artikel (judul, isi, slug) VALUE
('Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah
menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak
yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk
menjadi sebuah buku contoh huruf.', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang, Lorem Ipsum
bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin
klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah
mencapai lebih dari 2000 tahun.', 'artikel-kedua');**

Refresh kembali browser, sehingga akan ditampilkan hasilnya.

![image](https://github.com/user-attachments/assets/2081ddc0-5f4a-481a-85da-1674e44665be)

19. Membuat Tampilan Detail Artikel
Tampilan pada saat judul berita di klik maka akan diarahkan ke halaman yang berbeda.
Tambahkan fungsi baru pada Controller Artikel dengan nama **view**().

![image](https://github.com/user-attachments/assets/f407fc46-c2e9-48f7-9dac-7544ffc0ffd0)

20. Membuat View Detail
Buat view baru untuk halaman detail dengan nama **app/views/artikel/detail.php.**

![image](https://github.com/user-attachments/assets/52dcb932-f354-47e4-adfc-6c3d3d4c573e)

21. Membuat Routing untuk artikel detail
Buka Kembali file **app/config/Routes.php**, kemudian tambahkan routing untuk artikel detail.

![image](https://github.com/user-attachments/assets/96a83682-0286-4a77-ab61-74fd887711eb)

![image](https://github.com/user-attachments/assets/960ded60-038f-4163-917b-e92d9c3c165a)

22. Membuat Menu Admin
Menu admin adalah untuk proses CRUD data artikel. Buat method baru pada Controller
Artikel dengan nama **admin_index()**.

![image](https://github.com/user-attachments/assets/e857ac11-fafe-40d2-b0ec-3d3094c0a940)

Selanjutnya buat view untuk tampilan admin dengan nama **admin_index.php**

![Screenshot 2025-03-23 135513](https://github.com/user-attachments/assets/7a5e3ccf-89eb-4699-88a3-36317d84c097)

![Screenshot 2025-03-23 135534](https://github.com/user-attachments/assets/1a872862-e42b-4843-a3c1-443e099ffd8d)

![Screenshot 2025-03-23 135750](https://github.com/user-attachments/assets/bd54a369-8ce0-4851-bdc2-5d679efaf666)

![Screenshot 2025-03-23 135806](https://github.com/user-attachments/assets/4af20293-7339-4195-8d14-06a92594ddc6)

Tambahkan routing untuk menu admin seperti berikut:

![image](https://github.com/user-attachments/assets/03d240eb-467b-4508-a385-7051320b167f)

Akses menu admin dengan url http://localhost:8080/admin/artikel

![Screenshot 2025-03-23 140106](https://github.com/user-attachments/assets/a29dda68-4955-46d5-952d-79e928701737)

23. Menambah Data Artikel
Tambahkan fungsi/method baru pada Controller Artikel dengan nama add().

![image](https://github.com/user-attachments/assets/021a3384-b68b-4b3a-b8ac-4c670e476005)

Kemudian buat view untuk form tambah dengan nama **form_add.php**

![Screenshot 2025-03-23 140417](https://github.com/user-attachments/assets/60aa76cb-c0f2-4b26-a3b3-2728e6ca4a77)

![image](https://github.com/user-attachments/assets/c4523463-46d7-4213-af73-b958cd279108)

24. Mengubah Data
Tambahkan fungsi/method baru pada Controller Artikel dengan nama **edit().**

![image](https://github.com/user-attachments/assets/d8684394-4097-4550-be78-cdb8857ad6bb)

Kemudian buat view untuk form tambah dengan nama **form_edit.php**

![image](https://github.com/user-attachments/assets/e576d3f0-5785-4f69-9129-1945e790ad72)

![image](https://github.com/user-attachments/assets/300bb226-325c-4de1-9481-aa998e38b4c7)

25. Menghapus Data
Tambahkan fungsi/method baru pada Controller Artikel dengan nama **delete()**.

![image](https://github.com/user-attachments/assets/276a3ee5-2b3a-4470-8a1d-a662d94fcb91)

26. Membuat Layout Utama
Buat folder **layout** di dalam **app/Views/**
Buat file **main.php** di dalam folder **layout** dengan kode berikut:

![image](https://github.com/user-attachments/assets/c3ea7d25-7e97-4c06-a53a-26b3a2acaa03)

![image](https://github.com/user-attachments/assets/0051ef7e-24f6-4740-97c2-96f3ec10341f)

27. Modifikasi File View
Ubah **app/Views/home.php** agar sesuai dengan layout baru:

![image](https://github.com/user-attachments/assets/e5a2fbb3-064e-470c-98b0-aafe29a15e31)

28. Membuat Class View Cell
Buat folder **Cells** di dalam **app/**
Buat file **ArtikelTerkini.php** di dalam **app/Cells/** dengan kode berikut:

![image](https://github.com/user-attachments/assets/6be0740b-4e46-430b-bab6-20207e85e7d5)

29. Membuat View untuk View Cell
Buat folder components di dalam **app/Views/**
Buat file **artikel_terkini.php** di dalam **app/Views/components/** dengan kode berikut:

![image](https://github.com/user-attachments/assets/d250d040-7b4e-4ad9-9d63-c59293f2ce9c)

30. Menambahkan tanggal
tujuanya agar mendapatkan data aertikel yang baru di ubah

![image](https://github.com/user-attachments/assets/313b69f7-f993-4487-82ce-22c9817fb689)

contohnya seperti ini :

![image](https://github.com/user-attachments/assets/88d73672-4819-47fa-8d32-1c22c1b740a7)

Apa manfaat utama dari penggunaan View Layout dalam pengembangan aplikasi?
jawab : 
1. Struktur yang Terorganisir
  - Memudahkan pengaturan elemen UI dengan tata letak yang rapi dan terstruktur.

2. Responsivitas yang Lebih Baik
  - Memastikan tampilan UI menyesuaikan dengan berbagai ukuran layar dan orientasi perangkat.

3. Pemeliharaan Kode yang Lebih Mudah
  - Dengan pemisahan tata letak dan logika bisnis, perubahan UI lebih mudah dilakukan tanpa mengganggu fungsionalitas aplikasi.
    
4. Penggunaan Ulang Komponen
  - Layout dapat digunakan kembali di berbagai bagian aplikasi, mengurangi redundansi kode.

5. Kinerja yang Lebih Optimal
  - Beberapa jenis layout dioptimalkan untuk performa yang lebih baik, seperti ConstraintLayout di Android yang mengurangi jumlah view hierarchy.

Jelaskan perbedaan antara View Cell dan View biasa.
jawab : 
![image](https://github.com/user-attachments/assets/3f08a236-4d3c-4d34-ab79-991e4f154339)

31. Membuat tabel database dengan nama Tabel Login

![image](https://github.com/user-attachments/assets/d4540e2a-0474-4c50-a640-05f07f071c8c)

32. Selanjutnya membuat Tabel User di dalam database yang bernama Tabel Login

![image](https://github.com/user-attachments/assets/9801368a-85c1-42f6-a51f-4282871b228f)

33. Membuat Model User Selanjutnya adalah membuat Model untuk memproses data Login. Buat file baru pada direktori
app/Models dengan nama UserModel.php

![image](https://github.com/user-attachments/assets/d7c459a2-9457-4f42-a678-345fbb5f9c1d)

34. Membuat Controller User Buat Controller baru dengan nama User.php pada direktori app/Controllers. Kemudian
tambahkan method index() untuk menanmpilkan daftar user, dan method login() untuk proses login.

![image](https://github.com/user-attachments/assets/4d10fdd0-2a6f-4d8d-8830-676f70123339)
![image](https://github.com/user-attachments/assets/36405121-2820-46ec-8cb2-8bd42bffcab2)

35. Membuat View Login
Buat direktori baru dengan nama **user** pada direktori **app/views**, kemudian buat file baru
dengan nama **login.php**.

![image](https://github.com/user-attachments/assets/563f1db9-2aba-46d8-9517-51d5fc839866)

![image](https://github.com/user-attachments/assets/27388072-98f6-48a4-a13b-96d56d12dda9)

![image](https://github.com/user-attachments/assets/f8ae84cf-4da6-482f-a41a-60e0a8a4644d)

36. Membuat Database Seeder
Database seeder digunakan untuk membuat data dummy. Untuk keperluan ujicoba modul
login, kita perlu memasukkan data user dan password kedaalam database. Untuk itu buat
database seeder untuk tabel user. Buka CLI, kemudian tulis perintah berikut:

![image](https://github.com/user-attachments/assets/0133cd34-7f3b-4b7a-be57-4370ed32fdf5)

Selanjutnya, buka file **UserSeeder.php** yang berada di lokasi direktori
**/app/Database/Seeds/UserSeeder.php** kemudian isi dengan kode berikut:

![image](https://github.com/user-attachments/assets/a67d0b63-6801-4692-9c22-e2827d62bb8e)

Selanjutnya buka kembali CLI dan ketik perintah berikut:
![image](https://github.com/user-attachments/assets/1fb92733-1c1b-4ec3-aafc-17a4b6c30f6d)

37. **Uji Coba Login**
Selanjutnya buka url http://localhost:8080/user/login seperti berikut:

![image](https://github.com/user-attachments/assets/4797b1a2-0f46-41b7-9ea3-70560b0b7ff6)

38. Menambahkan Auth Filter
Selanjutnya membuat filer untuk halaman admin. Buat file baru dengan nama **Auth.php** pada
direktori **app/Filters**.

![image](https://github.com/user-attachments/assets/d07d3696-1d62-45b7-89a8-2fbe57c9656b)

39. Selanjutnya buka file **app/Config/Filters.php** tambahkan kode berikut:

![image](https://github.com/user-attachments/assets/ff38aa1a-f381-41c4-a3bc-ba21cce2f165)

40. Selanjutnya buka file **app/Config/Routes.php** dan sesuaikan kodenya.

![image](https://github.com/user-attachments/assets/ebeadfc0-c551-464e-bbee-dab9983d305a)

41. Percobaan Akses Menu Admin
Buka url dengan alamat http://localhost:8080/admin/artikel ketika alamat tersebut diakses
maka, akan dimuculkan halaman login.

![image](https://github.com/user-attachments/assets/4797b1a2-0f46-41b7-9ea3-70560b0b7ff6)

42. Fungsi Logout
Tambahkan method logout pada Controller User seperti berikut:

![image](https://github.com/user-attachments/assets/8697ca0a-b005-4472-9f0a-08356e4598df)

43. Untuk membuat pagination, buka Kembali **Controller Artikel**, kemudian modifikasi kode
pada method **admin_index** seperti berikut.

![image](https://github.com/user-attachments/assets/4e665aff-31e0-4a86-af0e-52f7a533c66e)

44. Kemudian buka file **views/artikel/admin_index.php** dan tambahkan kode berikut
dibawah deklarasi tabel data.

![image](https://github.com/user-attachments/assets/2ae8069c-78b2-4e3e-8f39-0acc4839bf9d)

45. Selanjutnya buka kembali menu daftar artikel, tambahkan data lagi untuk melihat
hasilnya.

<img width="824" alt="image" src="https://github.com/user-attachments/assets/0ac6ab12-3ec8-4b05-b161-eacb440b9cb4" />

46. Membuat Pencarian
Pencarian data digunakan untuk memfilter data.
Untuk membuat pencarian data, buka kembali **Controller Artikel**, pada method
**admin_index** ubah kodenya seperti berikut:

![image](https://github.com/user-attachments/assets/7a5c383d-959c-4029-b415-b8535068befd)

47. Kemudian buka kembali file **views/artikel/admin_index.php** dan tambahkan form
pencarian sebelum deklarasi tabel seperti berikut:

![image](https://github.com/user-attachments/assets/0b7ab4e8-934a-4c55-823a-ad88c89ac05e)

Dan pada link pager ubah seperti berikut.

![image](https://github.com/user-attachments/assets/b9b1133b-95d3-4256-80f9-e188bbbd1b5c)

48. Selanjutnya ujicoba dengan membuka kembali halaman admin artikel, masukkan kata
kunci tertentu pada form pencarian.

![image](https://github.com/user-attachments/assets/8ac7eb45-49f0-4447-ba5d-c365401afb4c)

49. Upload Gambar pada Artikel
Menambahkan fungsi unggah gambar pada tambah artikel.
Buka kembali **Controller Artikel** pada project sebelumnya, sesuaikan kode pada method
add seperti berikut:

![image](https://github.com/user-attachments/assets/37a6fdcb-3f00-4483-a167-814bcf8380f2)

50. Kemudian pada file **views/artikel/form_add.php** tambahkan field input file seperti
berikut.

![image](https://github.com/user-attachments/assets/48b23db0-53fc-4652-8516-523da1cc60cb)

51. Dan sesuaikan tag form dengan menambahkan ecrypt type seperti berikut.

![image](https://github.com/user-attachments/assets/e34fb0ed-2538-4ad8-9361-8c19105484e8)

52. Ujicoba file upload dengan mengakses menu tambah artikel.

![image](https://github.com/user-attachments/assets/79c060e2-c6b4-48f3-8446-8f3055c3463f)
