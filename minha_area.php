<?php
// =================================================================================
// DASHBOARD (minha_area.php)
// What does it do:
// 1. It shows the options of the user, such as:
//  - Their rooms
//  - Their files -- Now hidden
//  - Their courses
//  - Their reports -- Now hidden
//  - Their settings
// 2. Let the user log out
// =================================================================================

session_start();

// Database config file
include('conectar.php');

// -------------------------------------------------
// CHECK - User is logged in
// -------------------------------------------------
if(!isset($_SESSION['usuario_logado'])){    
    header("Location: inicio");
    exit;
}

$token_user = $_SESSION['token_usu'];
$nivel_user = $_SESSION['nivel_usu'];

$sql_user   = "SELECT * FROM usuarios WHERE token_usu = ?";
$stmt_user  = $mysqli->prepare($sql_user);
$stmt_user->bind_param("s", $token_user);
$stmt_user->execute();
$result_user= $stmt_user->get_result();
$infos_user = $result_user->fetch_array();

$nome_user  = explode(' ', $infos_user['nome_usu']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo $URL_GERAL; ?>">
    <title>Sala virtual - Minha área</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link rel="icon" type="image/png" href="favicon.png" />
    <link type="text/css" rel="stylesheet" href="extras/estilo_novo.css" media="all">
    <link type="text/css" rel="stylesheet" href="extras/estilo.css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container-centre">
        <div class="organise_options tab_redonda">
            <h1>Olá, <?=$nome_user[0];?>!</h1>
            <span>Aqui está o seu painel de controle. Selecione uma opção abaixo:</span>
            <p>
            <div class="dashboard-options">
                <!-- 1. SALAS -->
                <a href="salas">
                <div class="option_block tab_redonda">
                    <div>
                        <img src="imagens/apresentacao.png" width="70" alt="Ícone Salas"><br />
                        <h2>Salas</h2>
                        <span class="subtitulo">Acesse suas salas virtuais</span>
                    </div>                
                </div>
                </a>

                <!-- 2. ARQUIVOS 
                <a href="salas">
                <div class="option_block tab_redonda">
                    <div>
                        <img src="imagens/arquivos.png" width="70" alt="Ícone Salas"><br />
                        <h2>Salas</h2>
                        <span class="subtitulo">Documentos e materiais do curso</span>
                    </div>                
                </div>
                </a>-->

                <!-- 3. CURSOS -->
                <a href="cursos">
                <div class="option_block tab_redonda">
                    <div>
                        <img src="imagens/exercicio.png" width="70" alt="Ícone Salas"><br />
                        <h2>Cursos</h2>
                        <span class="subtitulo">Progresso e detalhes das aulas</span>
                    </div>                
                </div>
                </a>

                <!-- 4. CONFIGURAÇÕES -->
                <a href="configuracoes">
                <div class="option_block tab_redonda">
                    <div>
                        <img src="imagens/dados.png" width="70" alt="Ícone Salas"><br />
                        <h2>Configurações</h2>
                        <span class="subtitulo">Gerencie seu perfil e dados</span>
                    </div>                
                </div>
                </a>

                <!-- 5. SAIR -->
                <a href="sair">
                <div class="option_block tab_redonda">
                    <div>
                        <img src="imagens/sair.png" width="70" alt="Ícone Salas"><br />
                        <h2>Sair</h2>
                        <span class="subtitulo">Encerrar a sessão</span>
                    </div>                
                </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
