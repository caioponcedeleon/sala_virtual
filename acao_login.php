<?php
// =================================================================================
// ACTION FILE: login (acao_login.php)
// What does it do:
// 1. Receives infos from index.php and treat them to log in the user
// =================================================================================

session_start();

// Database config file
include('conectar.php');

// -------------------------------------------------
// 1. CHECK - Request by POST
// -------------------------------------------------
if($_SERVER["REQUEST_METHOD"] != "POST"){    
    // Redirects the user to index.php if not
    header("Location: inicio");
    exit;
}

// -------------------------------------------------
// 2. CHECK - Information has been sent
// -------------------------------------------------

$email_sent  = $_POST['email'] ?? '';
$senha_sent  = $_POST['senha'] ?? '';

// Checks whether one of the fields has been sent empty
if(empty($email_sent) || empty($senha_sent)){
    header("Location: inicio/m_1");
    exit;        
}

// -------------------------------------------------
// 3. CHECK - User exists
// -------------------------------------------------

$sql_user   = "SELECT senha_usu, token_usu, nivel_usu FROM usuarios WHERE email_usu = ?";
$stmt_user  = $mysqli->prepare($sql_user);
$stmt_user->bind_param("s", $email_sent);
$stmt_user->execute();
$result_user= $stmt_user->get_result();

if($result_user->num_rows == 0){
    header("Location: inicio/m_2");
    exit;
}

// -------------------------------------------------
// 4. CHECK - Password is correct
// -------------------------------------------------

$info_user  = $result_user->fetch_array();

if(!password_verify($senha_sent, $info_user['senha_usu'])){
    header("Location: inicio/m_3");
    exit;
}

// -------------------------------------------------
// All correct, logs in
// -------------------------------------------------

$_SESSION['usuario_logado']     = '1';
$_SESSION['token_usu']          = $info_user['token_usu'];
$_SESSION['nivel_usu']          = $info_user['nivel_usu'];
                
header("Location: minha_area");

// -------------------------------------------------
// Explicitly closes the connection
// -------------------------------------------------
$stmt_user->close();
$mysqli->close();

exit;
?>