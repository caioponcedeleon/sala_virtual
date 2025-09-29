<?php
include('conectar.php');

if(!isset($_GET['p'])){
	$pagina = 0;	
}else{
	$pagina = $_GET['p'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo $URL_GERAL; ?>">
<title>Sala virtual - Administração: apresentações</title>
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<link rel="icon" type="image/png" href="favicon.png" />
<link type="text/css" rel="stylesheet" href="estilo.css" media="all">
<script src="jquery.min.js"></script>
</head>

<body>
<p align="center" style="padding-top:50px;color:#3D3D3D;">&nbsp;</p>
<table align="center" width="80%" class="tab_redonda" border="0">
<?php
switch($pagina){
	case 0:
	?>
<tr>
<td><font size="+3"><strong>Administração - apresentações</strong></font>
  <p>Abaixo as apresentações salvas. Você também pode adicionar uma nova.</p>
  <?php
  if(isset($_GET['m'])){
  ?>
  <div id="atencao">
    <div class="tab_redonda" style="background-color:#FC6;text-align:center;"><strong>Atenção!</strong><br /><?php
    switch($_GET['m']){
		case 1:
			echo 'Erro ao adicionar apresentação! Tente novamente!';
		break;	
		case 2:
			echo 'Apresentação adicionada com sucesso!';
		break;
	}
	?></div><p>
    </div>
	<?php } ?>
  <p align="center"><a href="administracao/apresentacoes/criar" class="linknormal"><span class="tab_redonda_scor" style="background-color:#0CF;width:20%; text-align:center;">Adicionar nova apresentação</span></a></p></td>
</tr>
<tr>
<td>
<?php
	$mysql_apres = $mysqli->query("SELECT * FROM apresenta ORDER BY id_apre");
	$napr		 = $mysql_apres->num_rows;
	if($napr == 0){
	?>
    <p align="center"><font size="+1">Ainda não há apresentações</font></p>
    <?php	
	}else{
		?>
            <table border="0" cellpadding="10" width="100%">
          	<tr>
          	  <td width="35%" bgcolor="#CCCCCC"><strong>Nome da apresentação</strong></td><td bgcolor="#CCCCCC" width="35%"><strong>Descrição</strong></td><td bgcolor="#CCCCCC" align="center"><strong>Editar</strong></td><td width="20%" bgcolor="#CCCCCC" align="center"><strong>Criar sala</strong></td></tr>
            <?php
		while($infapr = $mysql_apres->fetch_array()){
			?>
            <tr><td width="40%"><?=$infapr['nom_apre'];?></td><td width="50%"><?=$infapr['desc_apre'];?></td>
              <td align="center"><a href="administracao/apresentacoes/a/<?=$infapr['token_apre'];?>" class="linknormal">abrir</a></td>
              <td align="center"><a href="acoes/nova_sala/s-<?=$infapr['token_apre'];?>" class="linknormal" target="_blank">criar</a></td></tr>
            <?php
		}
		?>
            </table>
            <?php
	}
	
?>
</td>
</tr>
<?php
	break;
	case 1:
		?>
        <tr>
<td><font size="+3"><strong>Administração - apresentações (criar)</strong></font>
  <p>Preencha o formulário abaixo para criar uma nova apresentação.</p><p align="center">
<a href="administracao/apresentacoes" class="linknormal"><span class="tab_redonda_scor" style="background-color:#999;width:20%; text-align:center;">&laquo; voltar</span></a>
</p></td>
</tr>
<tr>
<td>
<table align="center" cellpadding="10" width="50%" border="0">
<form action="acoes/add_apre" method="post" id="envia">
<tr>
    <td colspan="1" align="center"><strong>Nome da apresentação</strong><br /></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input name="titapre" type="text" class="estilo1" style="width:60%;" id="titapre" /></td>
  </tr><tr>
    <td colspan="1" class="traco_cima" align="center"><strong>Descrição</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><textarea name="descricao" class="estilo1" id="descricao" style="width:60%;"></textarea></td>
  </tr></form></table>
<p align="center"><a href="javascript:{}" onclick="document.getElementById('envia').submit(); return false;" class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;"><span>Adicionar apresentação</span></a></p>
  </td></tr>
        <?php
	break;
//======================= EDITA APRESENTACAO
	case 2:
	
	$token = $_GET['t'];
	
	$mysql_apres = $mysqli->query("SELECT * FROM apresenta WHERE token_apre = '$token'");
	$aprinfo	 = $mysql_apres->fetch_array();
	?>
    <tr>
<td><font size="+3"><strong>Administração - apresentação "<?=$aprinfo['nom_apre'];?>" </strong></font>
  <p>Abaixo você pode editar a apresentação, visualizar as transparências adicionadas ou adicionar novas.</p>
  <?php
  if(isset($_GET['m'])){
  ?>
  <div id="atencao">
    <div class="tab_redonda" style="background-color:#FC6;text-align:center;"><strong>Atenção!</strong><br /><?php
    switch($_GET['m']){
		case 1:
			echo 'Erro ao adicionar transparência! Tente novamente!';
		break;	
		case 2:
			echo 'Transparência adicionada com sucesso!';
		break;
		case 3:
			echo 'Erro ao editar transparência! Tente novamente!';
		break;	
		case 4:
			echo 'Transparência editada com sucesso!';
		break;
		case 5:
			echo 'Erro ao excluir transparência! Tente novamente!';
		break;	
		case 6:
			echo 'Transparência excluida com sucesso!';
		break;
	}
	?></div><p>
    </div>
	<?php } ?>
  <p align="center"><a href="administracao/apresentacoes/a/<?=$token;?>/adicionar_transparencia" class="linknormal"><span class="tab_redonda_scor" style="background-color:#0CF;width:20%; text-align:center;">Adicionar nova transparência</span></a></p></td>
</tr>
<tr>
<td>
<p align="center">
<a href="administracao/apresentacoes" class="linknormal"><span class="tab_redonda_scor" style="background-color:#999;width:20%; text-align:center;">&laquo; voltar</span></a>
</p>
<?php
	$mysql_trasp = $mysqli->query("SELECT * FROM transp WHERE tok_tra = '$token' ORDER BY n_tra");
	$ntras		 = $mysql_trasp->num_rows;
	if($ntras == 0){
	?>
    <p align="center"><font size="+1">Ainda não há transparências associadas</font></p>
    <?php	
	}else{
		?>
            <table border="0" cellpadding="10" width="100%">
          	<tr>
          	  <td width="5%" bgcolor="#CCCCCC"><strong>Parte no.</strong></td>
          	  <td bgcolor="#CCCCCC" width="35%"><strong>Título</strong></td>
              <td bgcolor="#CCCCCC" width="30%"><strong>Tipo</strong></td>
          	  <td bgcolor="#CCCCCC" align="center"><strong>Editar</strong></td>
          	  <td width="20%" bgcolor="#CCCCCC" align="center"><strong>Ver</strong></td></tr>
            <?php
		while($inftra = $mysql_trasp->fetch_array()){
			?>
            <tr><td><?=$inftra['n_tra'];?></td><td width="50%"><?=$inftra['tit_tra'];?></td>
              <td align="center"><?php switch($inftra['tipo_tra']){ case 1: echo 'normal'; break; case 2: echo 'exercicio'; break; }?></td><td align="center"><a href="administracao/apresentacoes/a/<?=$inftra['toktra_tra'];?>/editar_transparencia" class="linknormal">abrir</a></td>
              <td align="center"><a class="linknormal visualizar" id_este='<?=$inftra['toktra_tra'];?>'; style="cursor:pointer;" target="_blank">abrir</a></td></tr>
            <?php
		}
		?>
            </table>
            <?php
	}
	
?>
<script>
	$('.visualizar').on('click', function(){
		
		var id_este = $(this).attr('id_este');
		
		var map = window.open("visualiza_transp.php?mostra=1&t="+id_este, "", "status=0,title=0,height=650,width=800,scrollbars=0");
	});
</script>
</td>
</tr>
    <?php
	break;
//================= ADICIONAR TRANSPARENCIA
	case 3:
	
	$token = $_GET['t'];
	
	$mysql_apres = $mysqli->query("SELECT * FROM apresenta WHERE token_apre = '$token'");
	$aprinfo	 = $mysql_apres->fetch_array();
	
	$mysql_ntras = $mysqli->query("SELECT * FROM transp WHERE tok_tra = '$token'");
	$ntransp	 = $mysql_ntras->num_rows;
		?>
        <tr>
<td><font size="+3"><strong>Administração - adicionar transparência</strong></font>
  <p>Preencha o formulário abaixo para criar uma nova transparência.</p><p align="center">
<a href="administracao/apresentacoes/a/<?=$token;?>" class="linknormal"><span class="tab_redonda_scor" style="background-color:#999;width:20%; text-align:center;">&laquo; voltar</span></a>
</p></td>
</tr>
<tr>
<td>
<table align="center" cellpadding="10" width="50%" border="0">
<form action="acoes/add_tra" method="post" id="envia">
<tr>
    <td colspan="1" align="center"><strong>Associada à apresentação</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input name="apre" type="text" class="estilo1" value="<?=$aprinfo['nom_apre'];?>" style="width:60%;" disabled="disabled" id="apre" /><input name="apreid" type="hidden" value="<?=$token;?>" /></td>
  </tr><tr>
<tr>
    <td colspan="1" class="traco_cima" align="center"><strong>No. da parte</strong><br /></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input name="numero" type="number" class="estilo1" style="width:60%;" id="numero" value="<?=$ntransp+1;?>" /></td>
  </tr><tr>
    <td colspan="1" class="traco_cima" align="center"><strong>Título da transparência</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input name="titparte" type="text" class="estilo1" style="width:60%;" id="titparte" /></td>
  </tr><tr>
    <td colspan="1" class="traco_cima" align="center"><strong>Tipo</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2">
      <input type="radio" name="tipo" value="1" id="genero_0" />
      <label for="genero_0">normal</label>
      <input type="radio" name="tipo" value="2" id="genero_1" />
      <label for="genero_1">exercício</label></td>
  </tr><tr>
    <td colspan="1" class="traco_cima" align="center"><strong>Conteúdo</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><span class="traco_cima"><strong>
      <textarea name="cont" class="estilo1" id="cont" style="width:60%;"></textarea>
    </strong><p align="center"><a id="visu" class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;"><span>Visualizar transparência</span></a></p>
      <script>
	  $('#visu').on('click', function(){
		  var cont = $('#cont').val();
		  
		  function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/#/g, '₢').replace(/\+/g, '¤').replace(/&/g, '§');
}
		  
	 var map = window.open("visualiza_transp.php?a="+htmlEntities(cont), "", "status=0,title=0,height=650,width=800,scrollbars=0");
	  });
	  </script></span></td>
  </tr><tr class="ex" style="display:none;">
    <td colspan="1" class="traco_cima" align="center"><strong>Tamanho dos espaços</strong><br />
    <sub><em>por enquanto, apenas exercícios de completar espaços</em></sub></td>
  </tr>
  <tr class="ex" style="display:none;">
    <td align="center" colspan="2">
      <input type="radio" name="esptipo" value="1" id="esptipo_0" />
      <label for="esptipo_0">grandes</label>
      <input type="radio" name="esptipo" value="2" id="esptipo_1" />
      <label for="esptipo_1">pequenos</label></td>
  </tr><tr class="ex" style="display:none;">
    <td colspan="1" class="traco_cima" align="center"><strong>Texto do exercício com lacunas</strong><br />
    <sub><em>adicionar uma barra ( | ) onde deverá aparecer uma lacuna</em></sub></td>
  </tr>
  <tr class="ex" style="display:none;">
    <td align="center" colspan="2"><textarea name="texto_exc" class="estilo1" id="texto_exc" style="width:60%;"></textarea></td>
  </tr><tr class="ex" style="display:none;">
    <td colspan="1" class="traco_cima" align="center"><strong>Respostas na das lacunas</strong><br />
    <sub><em>separe-as por um ponto e vírgula ( ; )</em></sub></td>
  </tr>
  <tr class="ex" style="display:none;">
    <td align="center" colspan="2"><input name="resp_exc" type="text" class="estilo1" id="resp_exc" style="width:90%;" value="" /><p align="center"><a id="visu_ex" class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;"><span>Visualizar transparência com exercício</span></a></p><script>
	  $('#visu_ex').on('click', function(){
		  var cont = $('#cont').val();
		  var rest = $('#texto_exc').val();
		  var tama = $('input[name="esptipo"]:checked').val();
		  
		  function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/#/g, '₢').replace(/\+/g, '¤').replace(/&/g, '§');
}
		  
	 var map = window.open("visualiza_transp.php?a="+htmlEntities(cont)+"&b="+tama+"&c="+htmlEntities(rest), "", "status=0,title=0,height=650,width=800,scrollbars=0");
	  });
	  </script></td>
  </tr></form></table>
<p align="center"><a href="javascript:{}" onclick="document.getElementById('envia').submit(); return false;" class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;"><span>Adicionar transparência</span></a></p>

<script>
	$('[name="tipo"]').on('click', function(){
			if($(this).val() == '2'){
				$('.ex').fadeIn();
			}else{
				$('.ex').fadeOut();
			}
	});
</script>
  </td></tr>
        <?php
	break;
	//================= EDITAR TRANSPARENCIA
	case 4:
	
	$token = $_GET['t'];
	
	$mysql_ntras = $mysqli->query("SELECT * FROM transp WHERE toktra_tra = '$token'");
	$infos_trans = $mysql_ntras->fetch_array();
	$tokenapre_tr= $infos_trans['tok_tra'];
	
	$mysql_apres = $mysqli->query("SELECT * FROM apresenta WHERE token_apre = '$tokenapre_tr'");
	$aprinfo	 = $mysql_apres->fetch_array();
	
	
		 $codsexp = explode('§', $infos_trans['cont_tra']);
		?>
        <tr>
<td><font size="+3"><strong>Administração - editar transparência</strong></font>
  <p>Preencha o formulário abaixo para editar uma transparência.</p><p align="center">
<a href="administracao/apresentacoes/a/<?=$aprinfo['token_apre'];?>" class="linknormal"><span class="tab_redonda_scor" style="background-color:#999;width:20%; text-align:center;">&laquo; voltar</span></a>
</p></td>
</tr>
<tr>
<td>
<table align="center" cellpadding="10" width="50%" border="0">
<form action="acoes/ed_tra" method="post" id="envia">
<tr>
    <td colspan="1" align="center"><strong>Associada à apresentação</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input name="apre" type="text" class="estilo1" value="<?=$aprinfo['nom_apre'];?>" style="width:60%;" disabled="disabled" id="apre" /><input name="apreid" type="hidden" value="<?=$aprinfo['token_apre'];?>" /></td>
  </tr><tr>
<tr>
    <td colspan="1" class="traco_cima" align="center"><strong>No. da parte</strong><br /></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input name="numero" type="number" class="estilo1" style="width:60%;" id="numero" value="<?=$infos_trans['n_tra'];?>" /></td>
  </tr><tr>
    <td colspan="1" class="traco_cima" align="center"><strong>Título da transparência</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input name="titparte" type="text" class="estilo1" value="<?=$infos_trans['tit_tra'];?>" style="width:60%;" id="titparte" /></td>
  </tr><tr>
    <td colspan="1" class="traco_cima" align="center"><strong>Tipo</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2">
      <input type="radio" name="tipo" value="1" id="genero_0" <?php if($infos_trans['tipo_tra'] == 1){ echo ' checked="checked"'; }?> />
      <label for="genero_0">normal</label>
      <input type="radio" name="tipo" value="2" id="genero_1" <?php if($infos_trans['tipo_tra'] == 2){ echo ' checked="checked"'; }?> />
      <label for="genero_1">exercício</label></td>
  </tr><tr>
    <td colspan="1" class="traco_cima" align="center"><strong>Conteúdo</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><span class="traco_cima"><strong>
      <textarea name="cont" class="estilo1" id="cont" style="width:60%;height:100px;"><?php
      if($infos_trans['tipo_tra'] == 2){
		 echo $codsexp[0];
	  }else{
	  	echo $infos_trans['cont_tra'];
	  }?></textarea><br />
     <p align="center"><a id="visu" class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;"><span>Visualizar transparência</span></a></p>
      <script>
	  $('#visu').on('click', function(){
		  var cont = $('#cont').val();
		  
		  function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/#/g, '₢').replace(/\+/g, '¤').replace(/&/g, '§');
}
		  
	 var map = window.open("visualiza_transp.php?a="+htmlEntities(cont), "", "status=0,title=0,height=650,width=800,scrollbars=0");
	  });
	  </script>
    </strong></span></td>
  </tr><tr class="ex" <?php if($infos_trans['tipo_tra'] == 1){ ?>style="display:none;" <?php } ?>>
    <td colspan="1" class="traco_cima" align="center"><strong>Tamanho dos espaços</strong><br />
    <sub><em>por enquanto, apenas exercícios de completar espaços</em></sub></td>
  </tr>
  <tr class="ex" <?php if($infos_trans['tipo_tra'] == 1){ ?>style="display:none;" <?php } ?>>
    <td align="center" colspan="2">
      <input type="radio" name="esptipo" value="1" id="esptipo_0" <?php if($infos_trans['tipo_tra'] == 2){ if($codsexp[1] == 1){ echo 'checked="checked"'; } }?> />
      <label for="esptipo_0">grandes</label>
      <input type="radio" name="esptipo" value="2" id="esptipo_1" <?php if($infos_trans['tipo_tra'] == 2){ if($codsexp[1] == 1){ echo 'checked="checked"'; } } ?> />
      <label for="esptipo_1">pequenos</label></td>
  </tr><tr class="ex" <?php if($infos_trans['tipo_tra'] == 1){ ?>style="display:none;" <?php } ?>>
    <td colspan="1" class="traco_cima" align="center"><strong>Texto do exercício com lacunas</strong><br />
    <sub><em>adicionar uma barra ( | ) onde deverá aparecer uma lacuna</em></sub></td>
  </tr>
  <tr class="ex" <?php if($infos_trans['tipo_tra'] == 1){ ?>style="display:none;" <?php } ?>>
    <td align="center" colspan="2"><textarea name="texto_exc" class="estilo1" id="texto_exc" style="width:60%;height:100px;"><?php if($infos_trans['tipo_tra'] == 2){ echo $codsexp[3]; }?></textarea></td>
  </tr><tr class="ex" <?php if($infos_trans['tipo_tra'] == 1){ ?>style="display:none;" <?php } ?>>
    <td colspan="1" class="traco_cima" align="center"><strong>Respostas na das lacunas</strong><br />
    <sub><em>separe-as por um ponto e vírgula ( ; )</em></sub></td>
  </tr>
  <tr class="ex" <?php if($infos_trans['tipo_tra'] == 1){ ?>style="display:none;" <?php } ?>>
    <td align="center" colspan="2"><input name="resp_exc" type="text" class="estilo1" id="resp_exc" style="width:90%;" value="<?php if($infos_trans['tipo_tra'] == 2){ echo $codsexp[4]; }?>" /><p align="center"><a id="visu_ex" class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;"><span>Visualizar transparência com exercício</span></a></p><script>
	  $('#visu_ex').on('click', function(){
		  var cont = $('#cont').val();
		  var rest = $('#texto_exc').val();
		  var tama = $('input[name="esptipo"]:checked').val();
		  
		  function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/#/g, '₢').replace(/\+/g, '¤').replace(/&/g, '§');
}
		  
	 var map = window.open("visualiza_transp.php?a="+htmlEntities(cont)+"&b="+tama+"&c="+htmlEntities(rest), "", "status=0,title=0,height=650,width=800,scrollbars=0");
	  });
	  </script></td>
  </tr><input name="token" type="hidden" value="<?=$token;?>" /></form></table>
<p align="center"><a href="javascript:{}" onclick="document.getElementById('envia').submit(); return false;" class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;"><span>Editar transparência</span></a></p>
<p><br /></p>
<p align="center"><a href="acoes/deletar_transp/i-<?=$token?>" onclick="return confirm('Realmente deseja apagar esta transparência?')"  class="buttonnocor" style="vertical-align:middle; background-color:#F30;width:50%;"><span>Excluir transparência</span></a></p>
<script>
	$('[name="tipo"]').on('click', function(){
			if($(this).val() == '2'){
				$('.ex').fadeIn();
			}else{
				$('.ex').fadeOut();
			}
	});
</script>
  </td></tr>
        <?php
	break;
}
?>
</table><p>&nbsp;</p>
</body>
</html>
