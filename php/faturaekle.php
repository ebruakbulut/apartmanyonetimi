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
	$faturadonem=($_POST['faturadonem']);
	$faturatutar=($_POST['faturatutar']);
	$faturasontarih=($_POST['faturasontarih']);
	
 $db = pg_connect( "$host $port $dbname $user $password" );

 if(!$db) {
      echo "Error : Veritaban�na ba�lanamad�\n";
   } else {
      echo "";

   $sql ="INSERT INTO public.fatura(
	bilgi, faturadonem, faturatutar, faturasontarih)
	VALUES ('".$bilgi."','".$faturadonem."','".$faturatutar."','".$faturasontarih."');";

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
   } else {
      echo "Yeni Kay�t Olu�turuldu.\n";
   }
   }
   pg_close($db);
//

?>
