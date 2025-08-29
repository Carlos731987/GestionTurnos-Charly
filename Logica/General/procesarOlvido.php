<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../../Persistencia/conexionBD.php');
require_once('../../librerias/PHPMailer/src/PHPMailer.php');
require_once('../../librerias/PHPMailer/src/SMTP.php');
require_once('../../librerias/PHPMailer/src/Exception.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = ConexionBD::conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    //Verificar que existe el correo
    $stmt = $conn->prepare("SELECT id FROM pacientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($paciente_id);

    if ($stmt->fetch()) {
        $stmt->close();

        //Generar token
        $token = bin2hex(random_bytes(32));
        $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));
        //Guardar token
        $stmt = $conn->prepare("INSERT INTO recuperacion_password (paciente_id, token, fecha_expiracion) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $paciente_id, $token, $expiracion);
        $stmt->execute();
        $stmt->close();
        //Enviar correo
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();                                              
            $mail->Host       = cargarEnv('MAIL_HOST', 'smtp.gmail.com'); 
            $mail->SMTPAuth   = true;
            $mail->Username   = cargarEnv('MAIL_USERNAME');               
            $mail->Password   = cargarEnv('MAIL_PASSWORD');               
            $mail->SMTPSecure = cargarEnv('MAIL_ENCRYPTION', 'tls');      
            $mail->Port       = (int) cargarEnv('MAIL_PORT', 587);        

            $mail->setFrom(
                cargarEnv('MAIL_FROM', cargarEnv('MAIL_USERNAME')),
                cargarEnv('MAIL_FROM_NAME', 'Clinica')
            );
            $mail->addAddress($email, $nombrePaciente);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Recuperar acceso";
            $mail->Body = "
                <p>Hola,</p>
                <p>Has solicitado recuperar tu acceso.</p>
                <p>Haz clic aquí para continuar (válido por 1 hora):</p>
                <a href='http://192.168.0.66/interfaces/resetPassword.php?token=$token'>Recuperar acceso</a>
                <br><br>
                <small>Si no solicitaste este cambio, ignora este correo.</small>
            ";
            $mail->send();
        } catch (Exception $e) {
            echo "❌ Error al enviar correo: {$mail->ErrorInfo}";
        }
    }

    echo "<script>alert('Si tu correo está registrado, recibirás un enlace para restablecer tu contraseña.'); window.location.href='../../index.php';</script>";
}
