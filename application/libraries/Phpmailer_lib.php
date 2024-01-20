<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class PHPMailer_Lib
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        // Include PHPMailer library files
        //require_once APPPATH . 'vendor/phpmailer/phpmailer/src/Exception.php';
        //require_once APPPATH . 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
        //require_once APPPATH . 'vendor/phpmailer/phpmailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        return $mail;
    }
}
