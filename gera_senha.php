<?php

// 1. Receber a senha do usuário (a senha "limpa" ou em texto puro)
$senha_limpa = $_GET['n']; 

// 2. GERAR O HASH: Essa é a função MÁGICA
// O PASSWORD_DEFAULT garante que o algoritmo de hash seja o mais forte disponível no PHP (atualmente BCRYPT).
echo password_hash($senha_limpa, PASSWORD_DEFAULT); 

?>
