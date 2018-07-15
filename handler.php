<?php

require_once('lib/CallbackForm.php');
require_once('lib/callbackFormFooter.php');

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$file = isset($_FILES["file"]["name"]) ? trim($_FILES["file"]["name"]) : '';
$formType = isset($_POST['formType']) ? trim($_POST['formType']) : '';

$form = new CallbackForm($name, $phone);
$form2 = new CallbackForm2($name, $phone, $email, $file);

if ($_POST['formType'] == 'email') {
    if ($form2->validate()) {
        $form2->send();
        $form2->uploadFile();

    } else {
        echo 'Введите правильно данные!';
    }
} else {
    if ($form->validate()) {
        $form->send();
    } else {
        echo '</br>Введите правильно данные!';
    }
}
