<?php
// painel.php - Página protegida com boas-vindas

session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.html');
    exit;
}

$usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
$nivel = $_SESSION['nivel'] ?? 'usuario';
$dataLogin = htmlspecialchars($_SESSION['data_login'] ?? '', ENT_QUOTES, 'UTF-8');

if ($nivel === 'admin') {
    $mensagem = 'Você tem acesso de administrador. Pode acessar a página de perfil.';
} else {
    $mensagem = 'Você tem acesso de usuário comum.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container painel">
        <h2>✅ Bem-vindo, <?php echo $usuario; ?>!</h2>
        <p>Você está logado com sucesso no sistema.</p>

        <p class="info">Nível de acesso: <strong><?php echo htmlspecialchars($nivel, ENT_QUOTES, 'UTF-8'); ?></strong></p>
        <p class="info">Login realizado em: <strong><?php echo $dataLogin; ?></strong></p>
        <p class="nivel-msg"><?php echo $mensagem; ?></p>

        <?php if ($nivel === 'admin'): ?>
            <div class="logout">
                <a href="perfil.php">Ver perfil</a>
            </div>
        <?php endif; ?>

        <div class="logout">
            <a href="logout.php">Sair do sistema</a>
        </div>
    </div>
</body>
</html>