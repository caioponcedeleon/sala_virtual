<?php
include('conectar.php');

	$tinha = array("'", '"', "’", "“", "”", '‘', '’');
	$tenha = array("&#39;", "&quot;", "&#39;", "&ldquo;", "&rdquo;", "&#39;", "&#39;");
	
	
switch($_GET['a']){
	//================= LOGIN
	case 'login':
		
		$emaildado 		= $_POST['email'];
		$senhadada	 	= md5($_POST['senha']);
			
		$exe_logar = $mysqli->query("SELECT * FROM usuarios WHERE email_usu = '$emaildado' AND senha_usu = '$senhadada'");
		$num_logar = $exe_logar->num_rows;
		$userinfow = $exe_logar->fetch_array();
	
		if($num_logar == 1){
			
		$acessotoken = md5($userinfow['nome_usu'] . date('d/m/Y H:i:s'));
		$usuariotoken= $userinfow['token_usu'];
		$dataagora	 = date('Y-m-d H:i:s');
		
		setcookie('acesso', $acessotoken);
		
		$mysqli->query("INSERT INTO acessos VALUES(null,'$acessotoken','$usuariotoken','$dataagora')");
			
		echo '<script language="javascript">
		location.href="minha_area";
		</script>';
		
		}else{
			
			$exe_verificar = $mysqli->query("SELECT * FROM usuarios WHERE email_usu = '$emaildado'");
			$num_verificar = $exe_verificar->num_rows;
			
			if($num_verificar == 0){ //=== NÃO EXISTE
					echo '<script language="javascript">
				location.href="inicio/m_1";
				</script>';
			}else{ //=== SENHA ERRADA
				setcookie('emaildado', $emaildado);
				echo '<script language="javascript">
				location.href="inicio/m_2";
				</script>';
			}
		}
	break;	
	//================= ADICIONAR APRESENTACAO
	case 'add_apre':
		
		$titulo		= str_replace($tinha, $tenha, $_POST['titapre']);
		$desc		= str_replace($tinha, $tenha, $_POST['descricao']);
		$token		= md5(date('d/M/Y H:i:s'));
		$data		= date('d/M/Y H:i:s');
		
		if($mysqli->query("INSERT INTO apresenta VALUES(null,'$titulo','$token','$desc','$data')")){
				echo '<script language="javascript">
				location.href="../administracao/apresentacoes/m/2";
				</script>';
		}else{
				echo '<script language="javascript">
				location.href="../administracao/apresentacoes/m/1";
				</script>';
		}
	break;
	//================= ADICIONAR TRANSPARENCIA
	case 'add_tra':
		
		$apresenta	= $_POST['apreid'];
		$numero		= $_POST['numero'];
		$titulo		= str_replace($tinha, $tenha, $_POST['titparte']);
		$tipo		= $_POST['tipo'];
		$cont		= str_replace($tinha, $tenha, $_POST['cont']);
		$toknovo	= md5($titulo . date('d-m-Y H:i:s'));
		
		if($tipo == 2){
			//=== o "1" entre os paragrafos é para os futuros tipos de exercícios
			$contf	= $cont . '§1§'. $_POST['esptipo'] . '§' . str_replace($tinha, $tenha, $_POST['texto_exc']) . '§' . str_replace($tinha, $tenha, $_POST['resp_exc']);
		}else{
			$contf	= $cont;
		}
		
		if($mysqli->query("INSERT INTO transp VALUES(null,'$titulo','$apresenta','$numero','$tipo','$contf','$toknovo')")){
				echo '<script language="javascript">
				location.href="../administracao/apresentacoes/a/'.$apresenta.'/m/2";
				</script>';
		}else{
				echo '<script language="javascript">
				location.href="../administracao/apresentacoes/a/'.$apresenta.'/m/1";
				</script>';
		}
	break;
	
	//================= EDITAR TRANSPARENCIA
	case 'ed_tra':
		
		$apresenta	= $_POST['apreid'];
		$numero		= $_POST['numero'];
		$titulo		= str_replace($tinha, $tenha, $_POST['titparte']);
		$tipo		= $_POST['tipo'];
		$cont		= str_replace($tinha, $tenha, $_POST['cont']);
		$toknovo	= $_POST['token'];
		
		if($tipo == 2){
			//=== o "1" entre os paragrafos é para os futuros tipos de exercícios
			$contf	= $cont . '§1§'. $_POST['esptipo'] . '§' . str_replace($tinha, $tenha, $_POST['texto_exc']) . '§' . str_replace($tinha, $tenha, $_POST['resp_exc']);
		}else{
			$contf	= $cont;
		}
		
		if($mysqli->query("UPDATE transp SET tit_tra='$titulo',n_tra='$numero',tipo_tra='$tipo',cont_tra='$contf' WHERE toktra_tra = '$toknovo'")){
				echo '<script language="javascript">
				location.href="../administracao/apresentacoes/a/'.$apresenta.'/m/4";
				</script>';
		}else{
				echo '<script language="javascript">
				location.href="../administracao/apresentacoes/a/'.$apresenta.'/m/3";
				</script>';
		}
	break;
	
	//================= DELETA TRANSPARENCIA
	case 'deletar_transp':
	
		$token = $_GET['i'];
		
		$mysql_ntras = $mysqli->query("SELECT * FROM transp WHERE toktra_tra = '$token'");
		$infos_trans = $mysql_ntras->fetch_array();
		$tokenapre_tr= $infos_trans['tok_tra'];
		
		if($mysqli->query("DELETE FROM transp WHERE toktra_tra = '$token'")){
				echo '<script language="javascript">
				location.href="../../administracao/apresentacoes/a/'.$tokenapre_tr.'/m/6";
				</script>';
		}else{
				echo '<script language="javascript">
				location.href="../../administracao/apresentacoes/a/'.$tokenapre_tr.'/m/5";
				</script>';
		}
		
	break;
	//================= CRIA SALA COM APRESENTACAO
	case 'nova_sala':
		
		$tokcod		= $_GET['s'];
		
		function createRandomPassword() { 

			$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
			srand((double)microtime()*1000000); 
			$i = 0; 
			$pass = '' ; 
		
			while ($i <= 7) { 
				$num = rand() % 33; 
				$tmp = substr($chars, $num, 1); 
				$pass = $pass . $tmp; 
				$i++; 
			} 
		
			return $pass; 
		
		} 
		
		$okcod			= 0;
		do{
			$novo_tk	= createRandomPassword();
			
			$checacod	= $mysqli->query("SELECT * FROM sala WHERE tok_sala = '$novo_tk'");
			$ncodok		= $checacod->num_rows;
			
			if($ncodok == 0){
				$okcod += 1;	
				$codfim	= $novo_tk;
			}
		}
		while($okcod == 0);
		
		if($mysqli->query("INSERT INTO sala VALUES(null,'$codfim','$tokcod','0','1')")){
				echo '<script language="javascript">
				location.href="../../sala/professor/'.$codfim.'";
				</script>';
		}else{
				echo '<script language="javascript">
				location.href="../administracao/apresentacoes/m/3";
				</script>';
		}
	break;	
}
?>