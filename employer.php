<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'recruter58@gmail.com';
$mail->Password = 'nrgrsfagwqszwzih';

$mail->setFrom('recruter58@gmail.com', 'recruter58');
$mail->addAddress('recruter58@gmail.com');

$mail->Subject = 'Ищу кандидата на работу';

$body = '<h1>Данные заявки:</h1>';

if (trim(!empty($_POST['surname_employer']))) {
	$body.='<p><strong>Фамилия: </strong>'.$_POST['surname_employer'].'</p>';
}
if (trim(!empty($_POST['name_employer']))) {
	$body.='<p><strong>Имя: </strong>'.$_POST['name_employer'].'</p>';
}
if (trim(!empty($_POST['otchestvo_employer']))) {
	$body.='<p><strong>Отчество: </strong>'.$_POST['otchestvo_employer'].'</p>';
}
if (trim(!empty($_POST['company']))) {
	$body.='<p><strong>Компания: </strong>'.$_POST['company'].'</p>';
}
if (trim(!empty($_POST['address']))) {
	$body.='<p><strong>Адрес компании: </strong>'.$_POST['address'].'</p>';
}
if (trim(!empty($_POST['phone_employer']))) {
	$body.='<p><strong>Телефон: </strong>'.$_POST['phone_employer'].'</p>';
}
if (trim(!empty($_POST['email_employer']))) {
	$body.='<p><strong>Электронная почта: </strong>'.$_POST['email_employer'].'</p>';
}

$mail->Body = $body;

if (!$mail->send()) {
	$message = 'Ошибка';
} else {
	$message = 'Данные отправлены!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>