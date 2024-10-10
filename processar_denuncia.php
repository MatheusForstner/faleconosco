<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta as informações do formulário
    $tipo = htmlspecialchars($_POST['tipo']);
    $descricao = htmlspecialchars($_POST['descricao']);
    
    // Configurações do e-mail
    $to = 'ti@jng.com.br'; // Insira o seu e-mail aqui
    $subject = 'Nova Denúncia Anônima';
    $message = "Tipo de Denúncia: $tipo\n\nDescrição:\n$descricao";
    $headers = 'From: ti@jng.com.br' . "\r\n" . // E-mail fictício
               'Reply-To: ti@jng.com.br' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Envia o e-mail
    if (mail($to, $subject, $message, $headers)) {
        echo "Denúncia enviada com sucesso!";
    } else {
        echo "Erro ao enviar a denúncia. Tente novamente.";
    }
} else {
    echo "Método não permitido.";
}
?>
