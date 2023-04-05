<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function enviar_email($para, $assunto, $mensagem) {
global $config;

$mail = new PHPMailer(true);

$config = array(
    'host' => 'mail.lksagenciadigital.com.br',
    'port' => 465,
    'username' => 'posicionamentos@lksagenciadigital.com.br',
    'password' => 'Qwerty@747',
    'from_email' => 'posicionamentos@lksagenciadigital.com.br',
    'from_name' => 'Posicionamentos - Multilog',
    'reply_to_email' => 'posicionamentos@lksagenciadigital.com.br',
    'reply_to_name' => 'Posicionamentos - Multilog',
    'smtp_secure' => 'ssl',
    'charset' => 'UTF-8',
    'debug' => 0,
);

try {
    // Configurar o PHPMailer com as configurações do arquivo de configuração

    $mail->isSMTP();
    $mail->Host = $config['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['username'];
    $mail->Password = $config['password'];
    $mail->SMTPSecure = $config['smtp_secure'];
    $mail->Port = $config['port'];
    $mail->CharSet = $config['charset'];
    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addReplyTo($config['reply_to_email'], $config['reply_to_name']);

    // Adicionar o destinatário, o assunto e a mensagem
    $mail->isHTML(true);
    
    $mail->addAddress($para);
    $mail->Subject = $assunto;
    $mail->Body = $mensagem;

    // Enviar o e-mail

    $mail->send();
    return true;

    } catch (Exception $e) {
    // Tratar erros de envio de e-mail
        error_log('Erro ao enviar e-mail: ' . $mail->ErrorInfo);
        return false;
    }
}
?>