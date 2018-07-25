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
   $password="password=1234";
   $ad=($_POST['ad']);
	$soyad=($_POST['soyad']);
	$sifre=($_POST['sifre']);
	$sifret=($_POST['sifret']);
	$adres=($_POST['adres']);
	$eposta=($_POST['eposta']);
//if (!(empty($_POST['ad']) || empty($_POST['soyad']) || empty($_POST['sifre']) || empty($_POST['sifret']) || empty($_POST['adres']) || empty($_POST['telefon']))){
 $db = pg_connect( "$host $port $dbname $user $password" );

 if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";


   $sql ="INSERT INTO public.kisiler(
	kisi_ad, kisi_soyad, kisi_sifre, kisi_adres, kisi_eposta)
	VALUES ('".$ad."','".$soyad."','".$sifre."','".$adres."','".$eposta."');";

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
   } else {
      echo "Records created successfully\n";
   }
   }
   pg_close($db);
//

?>
