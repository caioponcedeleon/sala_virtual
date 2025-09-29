<?php
include('conectar.php');

if(isset($_COOKIE['acesso'])){
	$titulo = 'Minha área';
	
	$tkacesso = $_COOKIE['acesso'];
	
	$procuraacesso = $mysqli->query("SELECT * FROM acessos WHERE token_acesso = '$tkacesso'");
	$n_acesso = $procuraacesso->num_rows;
	
	if($n_acesso == 0){
		setcookie('acesso', '', time()-3600);
		
		echo '<script language="javascript">
		location.href="inicio/m_0";
		</script>';
	}else{
		$infosacesso = $procuraacesso->fetch_array();
		$tokenusuario= $infosacesso['usuario_acesso'];	
		
		$procurausu = $mysqli->query("SELECT * FROM usuarios WHERE token_usu = '$tokenusuario'");
		$usuinfos = $procurausu->fetch_array();
		
		$nomeusu = explode(' ', $usuinfos['nome_usu']);
	}
	
}else{
	$titulo = 'Entrar';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo $URL_GERAL; ?>">
<title>Sala virtual - <?=$titulo;?></title>
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<link rel="icon" type="image/png" href="favicon.png" />
<link type="text/css" rel="stylesheet" href="extras/estilo.css" media="all">
</head>

<body>
<p align="center" style="padding-top:50px;color:#3D3D3D;">&nbsp;</p>
<table align="center" width="80%" class="tab_redonda" style="padding-left:5%;padding-right:5%;" border="0">
<tr>
<td>
<table border="0" align="center"><tr><td valign="top">
<img src="imagens/logo.png" width="100" /></td><td><font style="font-size:37px; font-weight:900;" face="Louis Bold Italic">S@la<br />virtual</font></td></tr></table><p>
<?php
if(!isset($_COOKIE['acesso'])){
	//======================= LOGIN
	?>
    <table align="center" width="40%" class="tab_redonda" border="0" style="border:1px #ccc solid;">
    <tr>
    <td align="center"><font size="+2"><strong>Acesse sua conta</strong></font><p><?php if(isset($_GET['m'])){ switch($_GET['m']){ case 0: $msg = 'Por favor, entre novamente.'; break; case 1: $msg = 'Sua conta não foi encontrada. Por favor, confira seus dados e tente novamente.'; break; case 2: $msg = 'A senha entrada não está correta. Por favor, tente novamente.'; break; } ?><div class="aviso"><img src="imagens/atencao_1.png" width="25"><div class="spanaviso"><?=$msg;?></div></div><?php }?></td>
    </tr>
    <tr>
      <td align="left">
      <form action="acessar_conta" method="post">
      <strong>E-mail:</strong><br /><input name="email" type="email" required="required" style="width:98.5%;" id="email" value="<?php if(isset($_COOKIE['emaildado'])){ echo $_COOKIE['emaildado'];}?>" /><p>
      <strong>Senha:</strong><br /><input name="senha" type="password" required="required" style="width:98.5%;" /></p><p align="center">
      <input name="entrar" type="submit" id="entrar" value="Entrar" /></p>
      </form>
      </td>
    </tr>
    </table>
    <?php
}else{
	//============== LOGADO
	?>
    <font size="+3">Olá, <?=$nomeusu[0];?>!</font><br /><font size="+1">Que quer fazer hoje? Selecione uma opção abaixo para continuar!</font>
    <table cellpadding="15" width="100%" cellspacing="10" class="tds_redonda" border="0" align="center">
    <tr>
    <td rowspan="2" width="20%" valign="top">
    <font size="+2">Seu curso:</font>
    </td>
    <td align="center" width="26.6%"><a href="sala_apresentacao"><div><img src="imagens/apresentacao.png" width="70"><br />
        <font size="+2">Sala</font></div></a></td><td align="center" width="26.6%"><a href="vocabulario"><div><img src="imagens/dicionario.png" width="70"><br />
        <font size="+2">Vocabulário</font></div></a></td><td align="center" width="26.6%"><a href="exercicios"><div><img src="imagens/exercicio.png" width="70"><br /> <font size="+2">Exercícios</font></div></a></td>
    </tr>
    <tr>
      <td align="center"><a href="arquivos"><div><img src="imagens/arquivos.png" width="70"><br /><font size="+2">Arquivos</font></div></a></td>
      <td align="center"><a href="configuracoes"><div><img src="imagens/dados.png" width="70"><br />
        <font size="+2">Configurações</font></div></a></td>
      <td align="center"><a href="sair"><div><img src="imagens/sair.png" width="70"><br /><font size="+2">Sair</font></div></a></td>
    </tr>
    <?php
    if($usuinfos['nivel_usu'] == 1){
		?>
        <tr>
        <td align="center" valign="top" rowspan="3"><img src="imagens/administracao.png" width="70"><br /><font size="+2">Opções da administração</font></td>
        <td align="center"><a href="admin/aulas"><div><img src="imagens/transparencias.png" width="70"><br /><font size="+2">Aulas</font></div></a></td>
      <td align="center"><a href="admin/subir_arquivo"><div><img src="imagens/subarquivo.png" width="70"><br />
        <font size="+2">Subir arquivo(s)</font></div></a></td>
      <td align="center"><a href="admin/adicionar_exercicio"><div><img src="imagens/addexercicio.png" width="70"><br /><font size="+2">Adicionar exercícios</font></div></a></td>
        </tr>
        <tr>
         <td align="center"><a href="admin/relatorios"><div><img src="imagens/relatorios.png" width="70"><br /><font size="+2">Relatórios</font></div></a></td>
          <td align="center"><a href="admin/adicionar_vocabulario"><div><img src="imagens/palavras.png" width="70"><br /><font size="+2">Adicionar vocabulário</font></div></a></td>
           <td align="center"><a href="admin/informacoes_curso"><div><img src="imagens/infocurso.png" width="70"><br /><font size="+2">Informação do curso</font></div></td>
        </tr>
        <?php	
	}
	?>
    </table>
    <?php	
}
?>
</p></td>
</tr>
</table><p>&nbsp;</p>
</body>
</html>
