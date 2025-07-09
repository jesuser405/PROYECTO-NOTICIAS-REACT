<?php
// Incluir las clases necesarias de PHPMailer
require     'PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
require     'PHPMailer-master\PHPMailer-master\src\SMTP.php';
require     'PHPMailer-master\PHPMailer-master\src\Exception.php';

// Usar los namespaces de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Crear una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP(); // Usar SMTP
    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP (en este caso, Gmail)
    $mail->SMTPAuth = true; // Habilitar autenticación SMTP
    $mail->Username = 'jesusernestoortiz405@gmail.com'; // Dirección de correo del remitente
    $mail->Password = 'vnijgnhgnhhuurix'; // Contraseña o clave de aplicación del correo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Tipo de encriptación (TLS)
    $mail->Port = 587; // Puerto SMTP para TLS

    // Configuración del remitente y destinatario
    $mail->setFrom('jesusernestoortiz405@gmail.com', '104 CUBES'); // Dirección y nombre del remitente
    $mail->addAddress('jesusernestoortiz405@gmail.com', 'Jesus Ernesto Ortiz'); // Dirección y nombre del destinatario

    // Configuración del contenido del correo
    $mail->isHTML(true); // Indicar que el contenido es HTML
    $mail->Subject = 'Asunto del correo'; // Asunto del correo
    $mail->Body = 'Este es el cuerpo del correo.'; // Cuerpo del correo en formato HTML
    $mail->AltBody = 'Este es el cuerpo del correo en texto plano.'; // Cuerpo del correo en texto plano (opcional)

    // Enviar el correo
    $mail->send();
    echo '<div style="color: green; font-weight: bold; font-family: Arial, sans-serif; margin-top: 20px;">El mensaje se envió correctamente.</div>'; // Mensaje de éxito
} catch (Exception $e) {
    // Manejo de errores
    echo "Hubo un error al enviar el mensaje: " . htmlspecialchars($mail->ErrorInfo); // Mostrar el error de forma segura
}
