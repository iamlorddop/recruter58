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

$mail->Subject = 'Хочу найти работу';

$body = '<h1>Данные заявки:</h1>';

if (trim(!empty($_POST['surname_applicant']))) {
	$body.='<p><strong>Фамилия: </strong>'.$_POST['surname_applicant'].'</p>';
}
if (trim(!empty($_POST['name_applicant']))) {
	$body.='<p><strong>Имя: </strong>'.$_POST['name_applicant'].'</p>';
}
if (trim(!empty($_POST['otchestvo_applicant']))) {
	$body.='<p><strong>Отчество: </strong>'.$_POST['otchestvo_applicant'].'</p>';
}
if (trim(!empty($_POST['profession']))) {
	$body.='<p><strong>Профессия: </strong>'.$_POST['profession'].'</p>';
}
if (trim(!empty($_POST['salary']))) {
	$body.='<p><strong>Предполагаемая заработная плата: </strong>'.$_POST['salary'].'</p>';
}
if (trim(!empty($_POST['employment']))) {
	$body.='<p><strong>Желаемая форма занятости: </strong>'.$_POST['employment'].'</p>';
}
if (trim(!empty($_POST['phone_applicant']))) {
	$body.='<p><strong>Телефон: </strong>'.$_POST['phone_applicant'].'</p>';
}
if (trim(!empty($_POST['email_applicant']))) {
	$body.='<p><strong>Электронная почта: </strong>'.$_POST['email_applicant'].'</p>';
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