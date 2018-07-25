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

  $bilgi=($_POST['bilgi']);
	
	
 $db = pg_connect( "$host $port $dbname $user $password" );

 if(!$db) {
      echo "Error : Veritabanýna baðlanamadý\n";
   } else {
      echo "";


    $sql ="INSERT INTO public.duyuru(
	bilgi)
	VALUES ('".$bilgi."');";
	 
   $kntrl = pg_query($db, $sql);
   if(!$kntrl) {
      echo pg_last_error($db);
   } else {
      echo "Yeni Kayýt Oluþturuldu.\n";
   }
   }
   pg_close($db);


?>
