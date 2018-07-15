<?php

require_once('CallbackForm.php');

class CallbackForm2 extends CallbackForm
{
    public $email;
    public $file;

    public function __construct($name, $phone, $email, $file)
    {
        parent::__construct($name, $phone);
        $this->email = $email;
        $this->file = $file;
    }
    public function validate(): bool
    {
        if (empty($this->email) xor (!filter_var(($this->email), FILTER_VALIDATE_EMAIL))) {
            return false;
        }
        if (empty($this->file) xor (($_FILES["file"]["size"] > 5000000) ||
                (strtolower(substr(strrchr($_FILES["file"]["name"], '.'), 1))) != 'pdf')) {
            return false;
        }
        return parent::validate();
    }
    public function uploadFile ()
    {
        if (!file_exists('files/') && !empty($this->file)) {
            mkdir('files/', 0777, true);
        }
        if (!empty($this->file) && move_uploaded_file($_FILES["file"]["tmp_name"],
                'files/' . basename($_FILES["file"]["name"]))) {
            echo '<br>';
            echo 'Файл ' . basename( $_FILES["file"]["name"]) . ' успешно загружен!';
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
    }
}