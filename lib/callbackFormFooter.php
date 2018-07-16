<?php

require_once('CallbackForm.php');

class CallbackFormFooter extends CallbackForm
{
    public $email;
    protected $file;

    public function __construct($name, $phone, $email)
    {
        parent::__construct($name, $phone);
        $this->email = $email;
    }
    public function validate(): bool
    {
        if (empty($this->email) xor (!filter_var(($this->email), FILTER_VALIDATE_EMAIL))) {
            return false;
        }
        if (!empty($_FILES['pdf']['name']) && (($_FILES['pdf']['type'] !=='application/pdf') || $_FILES['pdf']['size'] > 5120000)) {
            return false;
        }
        return parent::validate();
    }
    public function uploadFile ()
    {
        if ((!file_exists('files/')) && (!empty($_FILES['pdf']['name']))) {
            mkdir('files/', 0777, true);
        }
        if (move_uploaded_file($_FILES["pdf"]["tmp_name"], 'files/' . basename($_FILES["pdf"]["name"]))) {
            echo '<br>';
            echo 'Файл ' . basename( $_FILES["pdf"]["name"]) . ' успешно загружен!';
        }

    }
    public function send()
    {
        echo 'Форма успешно отправлена';
        echo '<br>';
        parent::send();
        if (!empty($this->email)) {
            echo '<br>';
            echo 'Email: ' . $this->email;
        }
        $this->uploadFile();
    }
}