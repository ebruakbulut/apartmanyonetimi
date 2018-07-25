<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Headers:Content-Type');
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE,PUT');
header('Cache-Control:public,max-age=100');

   $host        = "host=localhost";
   $port        = "port=5432";
   $dbname      = "dbname=deneme";
   $user = 	"user=postgres";
   $password="password=ebru";
$responseData=new stdClass();
$db = pg_connect( "$host $port $dbname $user $password" );

if (!$db) {
  echo "Hataa.\n";
  exit;
}

$result = pg_query($db, "SELECT * FROM gelir ");
if (!$result) {
  echo "Mevcut deðil\n";
  exit;
}
else{
$rows = array();
while($r = pg_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode(array_values(pg_fetch_all($result)));
}



?>