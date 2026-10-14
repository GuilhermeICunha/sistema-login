<?php
// perfil.php - Página acessível apenas pelo admin

session_start();

// Precisa estar logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.html');
    exit;
}

// Precisa ser admin
if (($_SESSION['nivel'] ?? '') !== 'admin') {
    http_response_code(403);
    echo "
    <!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <title>Acesso negado</title>
        <link rel='stylesheet' href='css/estilo.css'>
    </head>
    <body>
        <div class='container error'>
            <h2>⛔ Acesso negado</h2>
            <p>Esta página é exclusiva para administradores.</p>
            <a href='painel.php'>Voltar ao painel</a>
        </div>
    </body>
    </html>";
    exit;
}

$usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
$nivel = htmlspecialchars($_SESSION['nivel'], ENT_QUOTES, 'UTF-8');
$dataLogin = htmlspecialchars($_SESSION['data_login'] ?? '', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container painel">
        <h2>👤 Perfil do administrador</h2>
        <p class="info">Usuário: <strong><?php echo $usuario; ?></strong></p>
        <p class="info">Nível: <strong><?php echo $nivel; ?></strong></p>
        <p class="info">Último login: <strong><?php echo $dataLogin; ?></strong></p>

        <div class="logout">
            <a href="painel.php">Voltar ao painel</a>
        </div>
    </div>
</body>
</html>