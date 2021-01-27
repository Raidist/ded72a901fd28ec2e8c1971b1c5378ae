# Send Email API

Program ini adalah teknikal test dari Raihan Dwi Satrio untuk DEOTrans.Program ini di jalankan lewat XAMPP 3.4.2 Dan menggunakan postgreSQL sebagai databasenya

## Instalasi

Untuk instalasi clone projek ini di direktori anda (Default di htdocs xampp).Masukan 1 pengguna kedalam database dengan id default id 1.\
Setting pengaturan database anda yang terdapat di Controller/Config/Conection.php dengan Default yang saya pakai sebagai berikut

```php
<?php 
$host = "localhost";
$port = "5432";
$dbname = "PHPResfulApi";
$user = "postgres";
$password = "secret"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$GLOBALS['dbconn'] = pg_connect($connection_string);
?>

``` 
Disini saya juga menggunakan PHPMailer sebagai sarana saya mengirim email.Agar fungsi ini bisa berjalan dengan baik anda harus mengatur STMP dari mail yang terdapat di Controller/ApiSendEmail.php seperti yang tertera sebagai berikut :
```php
   $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = '';
	$mail->SMTPAuth = true;
	$mail->username = '';
	$mail->password = '';
	$mail->SMTPSecure = 'tls'//'ssl';
	$mail->Port       = 587 // 465;
	$mail->SMTPOptions = array(
	'tls' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
	);
```

## Cara Penggunaan

Untuk menggunakan program ini terdapat 2 cara, yaitu dengan menggunakan index.php atau mengirim melalui Postman.Cara pertama menggunakan index.php:\
\
1.Buka index.php dan klik token untuk mendapatkan akses\
2.Masukan Email yang di tuju dan text yang anda inginkan\
\
Metode kedua menggunakan Postman :\
1.Gunakan Link http://localhost/ded72a901fd28ec2e8c1971b1c5378ae/Controller/GenerateTokenApi.php dengan metode POST (mengasumsikan kalau anda menjalankan projek ini di htdocs dan port default)\
2.Kirim parameter json body sebagai berikut

```json
{
	"id" : 1
}
```
dan hasil yang akan anda dapatkan berupa token sebagai berikut
```json
{
  "token": "R29sZGFuIEF1cmVvfDdlMjEzOWQzMTR8MDgyZWQ1Y2Y4ZGVhODlkZDYxYmU1ODdiNjc0OTBhYWQ=",
  "success": true,
  "message": "Token Created"
}
```
3.Ambil token yang anda dapatkan untuk mengirim parameter token dengan link http://localhost/ded72a901fd28ec2e8c1971b1c5378ae/Controller/ApiSendEmail.php dan parameter sebagai berikut

```json
{
  "email": "Test 12",
  "token": "R29sZGFuIEF1cmVvfGYyZTJiZWEzMWN8MDgyZWQ1Y2Y4ZGVhODlkZDYxYmU1ODdiNjc0OTBhYWQ=",
  "comment": "percobaan pengiriman "
}
```
dan akan mendapatkan respon sebagai berikut.
```json
{
  "success": "true",
  "message": "email sent"
}

```

## Informasi Teknis Tentang Program
Di sini saya memakai PHP 8.0.1, dan untuk struktur program ini saya memisahkan beberapa fungsi dalam beberapa file dan di panggil dengan fungsi php include/require\
\
Folder Controller adalah folder dimana eksekusi program maupun pengaturan berada.terbagi menjadi 3 folder yaitu BasicModule,Config,Request\
\
1.BasicModule folder dimana tempat fungsi-fungsi dasar berada yang di antaranya terdapat fungsi store,update,dan show
- dalam file DatabaseFunction.php fungsi store di jalan kan dengan parameter input yang berisikan data yang akan di input(dalam benruk array) dan nama tabel yang di tuju
- Sedangkan dalam fungsi update di jalankan dengan parameter input yang berisikan data yang akan di input,nama table yang di tuju,field yang di gunakan untuk menspesifikasi data yang di ubah, dan isi dari field dengan data yang akan di ubah
- Yang terakhir ada fungsi showWhere yang bisa di gunakan untuk mengambil data secara spesifik atau keseluruhan, dan di jalankan dengan parameter where yang berisikan data yang ingin di ambil secara spesifik dengan format "key" => "value" dengan key sebagai nama field dan value sebagai isi (array),nama table yang di tuju, dan limit untuk menentukan berapa batas data yang akan di ambil.

\
2.Config adalah folder dimana terdapat pengaturan database dan fungsi authentikasi program ini. Sistem token ini adalah sistem token yang saya buat untuk mengautentikasi pengguna dengan sistem sebagai berikut:
- Token di buat berdasar username,special id(yang akan di generate secara random untuk pengguna dan tersimpan di database pengguna),dan Signature yang saya buat dan saya enkripsi menggunakan fungsi md5.
- Semua data tadi saya satukan dan di pisahkan dengan simbol "|".\
- Dan data di enkripsi dengan fusng base64
- Parameter yang di berlukan untuk mengenerate token hanya "id" => "value id" berbentuk array

\
3.Request folder dimana terdapat Fungsi untuk mengirimkan request api dengan curl
- dalam file CurlRequest terdapat dungsi post untuk mengirimkan data dengan metode post, dan di jalankan dengan parameter url sebagai alamat API yang akan di gunakan dan input sebagai data yang akan di kirimkan (array)
