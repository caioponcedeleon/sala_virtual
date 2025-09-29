<?php
// =================================================================================
// LOGIN PAGE (index.php)
// What does it do:
// 1. Verifies whether the user is already logged in (based on SESSION "usuario_logado").
// 2. If so, redirects to dashboard.
// 3. If not, shows log in form.
// =================================================================================

session_start();

// Database config file
include('conectar.php');

// -------------------------------------------------
// CHECK - User is logged in
// -------------------------------------------------
if(isset($_SESSION['usuario_logado'])){    
    header("Location: minha_area");
    exit;
}

// O restante da lógica de tratamento de mensagens de erro (m_0, m_1, m_2, etc.) permanece
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="<?=$URL_GERAL;?>">
  <title>S@la virtual - Login</title>
  <link rel="icon" type="image/x-icon" href="favicon.ico" />
  <link rel="icon" type="image/png" href="favicon.png" />
  <link type="text/css" rel="stylesheet" href="extras/estilo_novo.css" media="all">
</head>
<body>
  <div class="container-login">
    <header class="logo-area tab_redonda">
      <img src="imagens/logo.png" width="80" />
      <br>
      S@la virtual
    </header>
    <div class="formulario-login tab_redonda">
      <h2><strong>Acesse sua conta</strong></h2>
      <?php 
        if(isset($_GET['m'])){
      ?>
        <div class="aviso">
          <img src="imagens/atencao_1.png" width="25">
          <div class="spanaviso">
            <?php 
              $errors_login = [
                0 => 'Por favor, entre novamente.',
                1 => 'Alguma informação está faltando. Por favor, preencha o formulário completo',
                2 => 'Sua conta não foi encontrada. Por favor, confira seus dados e tente novamente.',
                3 => 'A senha entrada não está correta. Por favor, tente novamente.',
                99 => 'Ocorreu um erro no acesso.'
              ];

              $error_code = (int)$_GET['m'];
              echo $errors_login[$error_code] ?? $errors_login[99];
            ?>
          </div>
        </div>
      <?php } ?>
      <form action="acao_login" method="post">
        <label for="email"><strong>E-mail:</strong></label>
        <input name="email" type="email" required="required" id="email" value="<?php if(isset($_COOKIE['emaildado'])){ echo $_COOKIE['emaildado'];}?>" />
        <p>
        <label for="senha"><strong>Senha:</strong></label>
        <input name="senha" type="password" required="required" />
        </p>
        <p align="center">
          <input name="entrar" type="submit" id="entrar" value="Entrar" />
        </p>
      </form>
    </div>
  </div>
</body>
</html>
