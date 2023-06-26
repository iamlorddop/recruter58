<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$connection = odbc_connect(
   "Driver={Microsoft Access Driver (*.mdb, *.accbd)};Dbq=recruter", 
   "root", 
   "root",
   SQL_CUR_USE_DRIVER
);

if (!$connection){
   if (phpversion() < '4.0'){
      exit("Connection Failed: . $php_errormsg" );
   }
   else{
      exit("Connection Failed:" . odbc_errormsg() );
   }
}

// пример

// $sql = "SELECT * FROM работодатели";

// $result = odbc_exec($connection, $sql);

// while(odbc_fetch_row($result)){
//    for($i=1;$i<=odbc_num_fields($result);$i++){
//       echo odbc_result($result, $i);
//       echo " ";
//    }
// }

// добавление записи в таблицу соискатели
if (trim(!empty($_POST['surname_applicant']))) {
   $surname = $_POST['surname_applicant'];
   $sql = "INSERT INTO соискатели (фамилия) VALUES ($surname)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['name_applicant']))) {
   $name = $_POST['name_applicant'];
   $sql = "INSERT INTO соискатели (имя) VALUES ($name)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['otchestvo_applicant']))) {
   $otchestvo = $_POST['otchestvo_applicant'];
   $sql = "INSERT INTO соискатели (отчество) VALUES ($otchestvo)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['profession']))) {
   $profession = $_POST['profession'];
   $sql = "INSERT INTO соискатели (профессия) VALUES ($profession)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['salary']))) {
   $salary = $_POST['salary'];
   $sql = "INSERT INTO соискатели (предполагаемый_размер_зп) VALUES ($salary)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['employment']))) {
   $employment = $_POST['employment'];
   $sql = "INSERT INTO соискатели (желаемая_форма_занятости) VALUES ($employment)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['phone_applicant']))) {
   $phone = $_POST['phone_applicant'];
   $sql = "INSERT INTO соискатели (телефон) VALUES ($phone)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['email_applicant']))) {
   $email = $_POST['email_applicant'];
   $sql = "INSERT INTO соискатели (электронная_почта) VALUES ($email)";
   $result = odbc_exec($connection, $sql);
}

// добавление записи в таблицу работодатели
if (trim(!empty($_POST['surname_employer']))) {
   $surname = $_POST['surname_employer'];
   $sql = "INSERT INTO работодатели (фамилия) VALUES ($surname)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['name_employer']))) {
   $name = $_POST['name_employer'];
   $sql = "INSERT INTO работодатели (имя) VALUES ($name)";
}
if (trim(!empty($_POST['otchestvo_employer']))) {
   $otchestvo = $_POST['otchestvo_employer'];
   $sql = "INSERT INTO работодатели (отчество) VALUES ($otchestvo)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['company']))) {
   $company = $_POST['company'];
   $sql = "INSERT INTO работодатели (компания) VALUES ($company)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['adress']))) {
   $address = $_POST['address'];
   $sql = "INSERT INTO работодатели (адрес) VALUES ($address)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['phone_employer']))) {
   $phone = $_POST['address'];
   $sql = "INSERT INTO работодатели (телефон) VALUES ($phone)";
   $result = odbc_exec($connection, $sql);
}
if (trim(!empty($_POST['email_employer']))) {
   $email = $_POST['email_employer'];
   $sql = "INSERT INTO работодатели (электронная_почта) VALUES ($email)";
   $result = odbc_exec($connection, $sql);
}

odbc_close($connection);
?>