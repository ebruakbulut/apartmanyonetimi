	
<?php
   $host        = "host=localhost";
   $port        = "port=5432";
   $dbname      = "dbname=proje";
   $user        = "user=postgres";
   $password="password=ebru";
   
 if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');   
    }
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	
		exit(0);
}
	
   $db = pg_connect( "$host $port $dbname $user $password" );
    if(!$db) {
      echo "Bağlantı hatası..";
   } else {
      echo "veritabanı bağlantısı sağlandı.";
   }
   
   pg_close($db);
?>