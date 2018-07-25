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

   $ad=($_POST['ad']);
	$soyad=($_POST['soyad']);
	$sifre=($_POST['sifre']);
	$sifret=($_POST['sifret']);
	$adres=($_POST['adres']);
	$telefon=($_POST['telefon']);

 $db = pg_connect( "$host $port $dbname $user $password" );

 if (($ad=="")||($soyad=="")||($sifre=="")||($sifret=="")||($adres=="")||($telefon=="")) {
   echo "Boş Alan Bırakmayınız.";
   return;
 }
 if ($sifre!=$sifret) {
   echo "Şifreler eşleşmiyor";
   return;
 }
 if (strlen($sifre)<4) {
   echo "Şifreniz en az  4 karakter olmalı";
   return;
 }


 if(!$db) {
      echo "Error : Veritabanına bağlanamadı\n";
   } else {
      echo "";


   $sql ="INSERT INTO public.kisiler(
	kisi_ad, kisi_soyad, kisi_telefon, kisi_sifre, kisi_adres)
	VALUES ('".$ad."','".$soyad."','".$telefon."','".$sifre."','".$adres."');";

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
   } else {
      echo "Yeni Kayıt Oluşturuldu.\n";
   }
   }
   pg_close($db);
//

?>
