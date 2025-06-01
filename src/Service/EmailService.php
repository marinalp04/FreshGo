<?php
namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private string $fromEmail = 'freshandgo.pedidos@gmail.com';
    private string $fromName = 'Fresh&Go Pedidos';
    private string $appPassword = 'upfn nnmo avhb xuhu';

    public function enviarResumenPedido(string $destinatario, string $nombreCliente, string $htmlMensaje): bool
    {
        $mail = new PHPMailer(true);

        try {
            // Configuración SMTP de Gmail
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->fromEmail;
            $mail->Password   = $this->appPassword;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Remitente y destinatario
            $mail->setFrom($this->fromEmail, $this->fromName);
            $mail->addAddress($destinatario, $nombreCliente);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Resumen de tu pedido en Fresh&Go';
            $mail->Body    = $htmlMensaje;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
