<?php
   $host        = "host=localhost";
   $port        = "port=5432";
   $dbname      = "dbname=proje";
   $user = "user=postgres";
   $password="password=ebru";

   $db = pg_connect( "$host $port $dbname $user $password" );

   if(!$db) {
      echo "Veritabanı bağlantı hatası";
   } else {
      echo "veritabanı baglantısı tamamlandı";
   }

   $sql =<<<EOF
      SELECT * from kullanici_bilgi;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   while($row = pg_fetch_row($ret)) {
      echo "İD = ". $row[0] . "\n";
      echo "AD = ". $row[1] ."\n";
      echo "SOYAD =". $row[2] ."\n";
      echo "TELEFON=".$row[4] ."\n\n";
	   
   }
 
   pg_close($db);
?>