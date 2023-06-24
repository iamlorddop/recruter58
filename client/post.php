<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$connection = odbc_connect("rectuter", "root", "root");

if (!$connection){
   if (phpversion() < '4.0'){
      exit("Connection Failed: . $php_errormsg" );
   }
   else{
      exit("Connection Failed:" . odbc_errormsg() );
   }
}

$sql = "SELECT * FROM работодатели";

$result = odbc_exec($connection, $sql);

while(odbc_fetch_row($result)){
   for($i=1;$i<=odbc_num_fields($result);$i++){
      echo odbc_result($result, $i);
      echo " ";
   }
}

odbc_close($connection);
?>