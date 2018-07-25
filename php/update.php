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
      UPDATE COMPANY set SALARY = 56780.00 where ID=1;
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } else {
      echo "Güncelleme başarılı";
   }
   
   $sql =<<<EOF
      SELECT * from COMPANY;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   while($row = pg_fetch_row($ret)) {
      echo "ID = ". $row[0] . "\n";
      echo "NAME = ". $row[1] ."\n";
      echo "ADDRESS = ". $row[2] ."\n";
      echo "SALARY =  ".$row[4] ."\n\n";
   }
  
   pg_close($db);
?>