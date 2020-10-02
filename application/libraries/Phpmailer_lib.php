<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailer_Lib
{
  public function __construct(){
    log_message('Debug', 'PHPMailer class is loaded.');
  }

  public function load(){
    // Include PHPMailer library files
    require_once APPPATH.'third_party/PHPMailer/Exception.php';
    require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
    require_once APPPATH.'third_party/PHPMailer/SMTP.php';
    
    $mail = new PHPMailer(TRUE);
    $mail->isSMTP();
    $mail->Host = "smtp.office365.com";
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'noreply@uib.ac.id';
	  $mail->Password = 'Qwerty12345';
	  $mail->Port = 587;
    return $mail;
  }
}
?>