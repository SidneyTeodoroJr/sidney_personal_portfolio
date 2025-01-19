<?php
// Verifica se o método de envio é POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // Valida campos obrigatórios
    if (empty($name) || empty($email) || empty($message)) {
        http_response_code(400);
        echo "All fields are required.";
        exit;
    }

    // Valida formato de e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email address.";
        exit;
    }

    // Configurações do e-mail
    $to = "sidneyteodoroaraujojunior2002@gmail.com";
    $headers = "From: $email\r\nReply-To: $email\r\n";
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message\n";

    // Envia o e-mail
    if (mail($to, $subject, $email_body, $headers)) {
        echo "OK";
    } else {
        http_response_code(500);
        echo "Failed to send the email. Please try again later.";
    }
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
?>