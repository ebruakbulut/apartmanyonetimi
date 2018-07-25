<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Headers:Content-Type');
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE,PUT');
header('Cache-Control:public,max-age=100');

   $host        = "host=localhost";
   $port        = "port=5432";
   $dbname      = "dbname=deneme";
   $user = "user=postgres";
   $password="password=ebru";

$db = pg_connect( "$host $port $dbname $user $password" );

$responseData=new stdClass();
if ($db) {
  $utf="SET NAMES 'utf8'";
  pg_query($db, $utf);
 if (true) {
    //bos mu dolu mu diye kontrol ettik
$ad=$_GET['ad'];
$sifre=$_GET['sifre'];
//veritabanında kontrol ediyoruz varmı diye
$query="SELECT*FROM kisiler WHERE kisi_ad='".$ad."' and kisi_sifre='".$sifre."'";
// bir sonuc tutuldu sonuc bır data olarak tanımlandı eger varsa yanıt gonderıldı yoksa hatalı mesaj

$result= pg_query($db,$query);

if ($result) {
  # code...

if ($row= pg_fetch_row($result)) {
  $responseData -> data=$row;
echo json_encode($responseData);
}else {
  $responseData->errorMessage="Hatalı Kullanıcıadı Veya Şifre Girdiniz Veya Girilecek Alanlar Boş Bırakılmaz";
  echo json_encode($responseData);
}}

  }else {
    $responseData ->errorMessage ="Girilecek Alanlar Boş Bırakılmaz";
    echo json_encode($responseData);
  }
}
else {
  $responseData ->errorMessage ="Veritabanına Bağlanamadı";
  echo json_encode($responseData);
}
 ?>
