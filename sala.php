<?php
include('conectar.php');

if(!isset($_GET['t'])){
	
}else{
	
	$tokensala	 = $_GET['t'];
	
	  $tinha = array("'", '"', "\n", "’", "“", "”", '‘', '’');
	$tenha = array("&#39;", "&quot;", "<br>","&#39;", "&ldquo;", "&rdquo;", "&#39;", "&#39;");
	
  if(isset($_POST['nome'])){
	  $nome_novo = str_replace($tinha, $tenha, $_POST['nome']);
	  $urlaqui = $URL_GERAL . '/sala/'.$tokensala;
		setcookie('nome_usuario', $nome_novo, time()+4000, $urlaqui);
		$agora = date('Y-m-d H:i:s');
		
		$mysqli->query("INSERT INTO online VALUES(null,'$nome_novo','$tokensala','$agora')");
		
		echo '<script language="javascript">
	location.href="../sala/'.$tokensala.'";
	</script>';
  }
	
	
	$mysql_sala	 = $mysqli->query("SELECT * FROM sala WHERE tok_sala = '$tokensala'");
	$salinfo	 = $mysql_sala->fetch_array();
	
	$tokapres	 = $salinfo['apre_sala'];
	
	$mysql_apre	 = $mysqli->query("SELECT * FROM apresenta WHERE token_apre = '$tokapres'");
	$aprinfo	 = $mysql_apre->fetch_array();
	
	$mysql_tras	 = $mysqli->query("SELECT * FROM transp WHERE tok_tra = '$tokapres'");
	$trasntot	 = $mysql_tras->num_rows;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo $URL_GERAL; ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sala virtual - Apresentação: "
<?=$aprinfo['nom_apre'];?>
"</title>
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<link rel="icon" type="image/png" href="favicon.png" />
<link type="text/css" rel="stylesheet" href="estilo.css" media="all">
<script src="jquery.min.js"></script>
</head>

<body>
<p align="center" style="padding-top:50px;color:#3D3D3D;">&nbsp;</p>
<table align="center" width="80%" class="tab_redonda" border="0">
<tr>
<td><strong><font size="+3">Apresentação &quot;<?=$aprinfo['nom_apre'];?>&quot;</font></strong>
  <p>
  <?php

  
  if(!isset($_COOKIE['nome_usuario'])){
	  ?><p align="center">
      <font size="+2">Escreva seu nome abaixo para começar:</font>
      </p>
      <form action="sala/<?=$_GET['t'];?>" name="entra" id="entra" method="post">
      <p align="center"><input name="nome" class="estilo1" type="text" id="nome" style="width:30%;height:30px;" /><br /></p>
</form>
<p align="center"><a href="javascript:{}" onclick="document.getElementById('entra').submit(); return false;" class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;"><span>Continuar</span></a></p>

      <?php
  }else{
  ?>
<div class="tab_redonda_scor" style="height:500px;overflow:hidden;">
<div id="visor" style="width:98%;max-height:95% !important;overflow-y:auto;border-radius: 10px 10px 10px 10px;padding:10px;overflow-x:hidden;">
<p align="center">carregando...</p>
</div>
</div>
<p align="center"><strong>Participantes</strong><p><p align="center"><span id="participantes">Carregando...</span></p>
<?php } ?>

</td>
</tr>
</table>
<input name="t_nova" id="t_nova" type="hidden" value="" />
<input name="t_agora" id="t_agora" type="hidden" value="" />
<input name="v_nova" id="v_nova" type="hidden" value="" />
<input name="v_agora" id="v_agora" type="hidden" value="" />
<script type="text/javascript">
setInterval( checaMudancaG, 1000 );
setInterval( checaMudancaV, 1100 );
setInterval( checaMudancaP, 1000 );
setInterval( checaMudancaPe, 1000 );

  
  function checaMudancaV(){
		var v_agora = $('#v_agora').val();
		var v_nova  = $('#v_nova').val();
		if(v_agora != v_nova){
			$("#v_agora").val(v_nova);
			
			$.getJSON("pedidos/pega_info_t/s-<?=$tokensala;?>/usu-<?=$_COOKIE['nome_usuario'];?>", function(result) {
				$("#visor").html(result['html']);
			});	
		}
	}
	
	function checaMudancaP() {
   $.getJSON("pedidos/checa_participantes/s-<?=$tokensala;?>", function(result) {
		
		$('#participantes').html(result['html']);
		
	});
  }
  
  function checaMudancaPe() {
  var datab	= 'nome=<?=$_COOKIE['nome_usuario'];?>';
				$.ajax({
					 type: "POST",
					 url: "pedidos/atualiza_participante/s-<?=$tokensala?>",
					 data: datab,
					 success: function(phpReturnResult){
					 },
					 error: function(errormessage) {
					 }
				});
  }
	
  function checaMudancaG() {
   $.getJSON("pedidos/checa_mudancas/s-<?=$tokensala?>", function(result) {
	   	var t_nova = $('#t_nova').val();
		var v_nova = $('#v_nova').val();
		
		
		if(t_nova != result['trasp']){
      		$("#t_nova").val(result['trasp']);
		}
		if(v_nova != result['varia']){
      		$("#v_nova").val(result['varia']);
		}
	});
  }  
   
  
</script>
</body>
</html>
<?php } ?>