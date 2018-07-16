<?php

require_once('lib/CallbackForm.php');
require_once('lib/CallbackFormFooter.php');

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$formType = isset($_POST['formType']) ? trim($_POST['formType']) : '';

if ($formType) {
    $form = new CallbackForm($name, $phone);
} else {
    $form = new CallbackFormFooter($name, $phone, $email);
}

if ($form->validate()) {
    $form->send();
} else {
    echo '</br>Введите правильно данные!';
}