<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$connection = odbc_connect("recruter", "", "");

// Пример
$sql = "SELECT * FROM соискатели";

$result = odbc_exec($connection, $sql);

while(odbc_fetch_row($result)){
	for($i=1; $i <= odbc_num_fields($result); $i++){
		echo odbc_result($result, $i);
		echo " ";
	}
}

?>