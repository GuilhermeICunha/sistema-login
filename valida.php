<?php
// valida.php - Processa o login e inicia a sessão

session_start();
date_default_timezone_set('America/Sao_Paulo');

// Dados simulados (em produção: use banco de dados)
$usuarios = [
    'admin'   => ['senha' => '12345', 'nivel' => 'admin'],
    'usuario' => ['senha' => 'abcde', 'nivel' => 'usuario'],
];

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if (isset($usuarios[$usuario]) && $usuarios[$usuario]['senha'] === $senha) {
    $_SESSION['logado'] = true;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nivel'] = $usuarios[$usuario]['nivel'];
    $_SESSION['data_login'] = date('d/m/Y H:i:s');
    header('Location: painel.php');
    exit;
} else {
    echo "
    <!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <title>Erro</title>
        <link rel='stylesheet' href='css/estilo.css'>
    </head>
    <body>
        <div class='container error'>
            <h2>❌ Login inválido!</h2>
            <p>Usuário ou senha incorretos.</p>
            <a href='login.html'>Tentar novamente</a>
        </div>
    </body>
    </html>";
}
?>