<?php
include('conectar.php');

if(!isset($_GET['t'])){
	
}else{
	$tokensala	 = $_GET['t'];
	
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
<td colspan="2"><strong><font size="+3">Apresentação &quot;<?=$aprinfo['nom_apre'];?>&quot; - modo professor</font></strong>
  <p>
  <p align="center">
  Link da sala de aluno:<br />
  <input class="estilo1" readonly="readonly" style="width:95%;height:30px; font-size:16px;" value="<?=$URL_GERAL;?>sala/<?=$tokensala;?>" />
  </p>
<table border="0" width="100%"><tr>
<td width="80%" valign="top"><strong>
Apresentando agora:</strong>
  <p>
  <div class="tab_redonda_scor" style="height:500px;overflow:hidden;">
<div id="visor" style="width:98%;max-height:95% !important;overflow-y:auto;border-radius: 10px 10px 10px 10px;padding:10px;overflow-x:hidden;">
<p align="center">carregando...</p>
</div>
</div></td>
<td valign="top" style="padding-left:20px;" align="center"><strong>Controles</strong>
<table border="0" width="100%"><tr><td><p align="center"><a id="voltar" style="cursor:pointer;width:100%;" ir-para="" class="linknormal" ><span class="tab_redonda_scor cor_amarela" style="width:20%; text-align:center;">&laquo; Voltar ao anterior</span></a><br /></p></td></tr>
  <tr>
    <td><p align="center"><a id="avancar" ir-para="" style="cursor:pointer;width:100%;" class="linknormal"><span class="tab_redonda_scor cor_amarela" style="width:20%; text-align:center;">Ir ao próximo &raquo;</span></a>
</p></td>
  </tr>
</table>
<hr />
<strong>Participantes</strong><p>
<span id="participantes">Carregando...</span></p>
</td></tr></table>
</td></tr><tr><td valign="top" width="60%">
<table border="0" cellpadding="10" width="100%" align="center">
<tr><td align="center" width="50%"><p align="center">Anterior</p><div class="tab_redonda_scor" style="height:300px;padding:0;margin:0;overflow:hidden;" id="visor_ant">
<p align="center">carregando...</p>
</div></td><td align="center"><p align="center">Próximo</p><div class="tab_redonda_scor" style="height:300px;padding:0;margin:0;overflow:hidden;" id="visor_pro">
<p align="center">carregando...</p>
</div></td></tr>
</table>
</td><td style="padding-left:30px;border-left:2px #CCC solid;">
<table align="center" border="0"><tr><td>
<p align="center">
<a id="mostrar" style="cursor:pointer;" ir-para="" class="linknormal"><span class="tab_redonda_scor cor_amarela" style="width:20%; text-align:center;">mostrar respostas</span></a></p></td><td><p align="center"><a id="apagar_resp" ir-para="" style="cursor:pointer;display:none;" class="linknormal"><span class="tab_redonda_scor cor_amarela" style="width:20%; text-align:center;">Apagar respostas</span></a>
</p></td></tr></table>
<strong>Respostas:</strong>
  <p><div id="respostas" style="height:500px;padding:0;margin:0;overflow:hidden;">carregando...</div></td>
</tr>
<tr>
<td>

</td>
</tr>
</table>
<input name="t_nova" id="t_nova" type="hidden" value="" />
<input name="t_agora" id="t_agora" type="hidden" value="" />
<input name="v_nova" id="v_nova" type="hidden" value="" />
<input name="v_agora" id="v_agora" type="hidden" value="" />
<script type="text/javascript">
setInterval( checaMudancaG, 1000 );
setInterval( checaMudancaT, 1100 );
setInterval( checaMudancaV, 1100 );
setInterval( checaMudancaR, 1100 );
setInterval( checaMudancaP, 1000 );

	function checaMudancaT(){
		var t_agora = $('#t_agora').val();
		var t_nova  = $('#t_nova').val();
		
		if(t_agora != t_nova){
			$("#t_agora").val(t_nova);
			var volta = Number(t_nova) - 1;
			var vai	  = Number(t_nova) + 1;
			$("#voltar").attr('ir-para', volta);
			$("#avancar").attr('ir-para', vai);
			
			$.getJSON("pedidos/pega_info_t/s-<?=$tokensala;?>", function(result) {
				$("#visor").html(result['html']);
			});
			$.getJSON("pedidos/pega_info_t_a/s-<?=$tokensala;?>", function(result) {
				$("#visor_ant").html(result['html']);
			});
			$.getJSON("pedidos/pega_info_t_p/s-<?=$tokensala;?>", function(result) {
				$("#visor_pro").html(result['html']);
			});	
		}
	}
	
	function checaMudancaV(){
		var v_agora = $('#v_agora').val();
		var v_nova  = $('#v_nova').val();
		
		if(v_agora != v_nova){
			$("#v_agora").val(v_nova);
			
			$.getJSON("pedidos/pega_info_t/s-<?=$tokensala;?>", function(result) {
				$("#visor").html(result['html']);
			});	
			
		}
	}
  
  function checaMudancaR() {
   $.getJSON("pedidos/checa_respostas/s-<?=$tokensala?>", function(result) {
		$("#respostas").html(result['html']);
	});
  }
  
  function checaMudancaP() {
   $.getJSON("pedidos/checa_participantes_p/s-<?=$tokensala;?>", function(result) {
		
		$('#participantes').html(result['html']);
		
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
  
  $('#mostrar').on('click', function(){
		var data	= 'comando=' + 1;
				$.ajax({
					 type: "POST",
					 url: "pedidos/atualiza_comando/s-<?=$tokensala?>",
					 data: data,
					 success: function(phpReturnResult){
						  alert('Resultados apresentados!');  
						  $('#apagar_resp').fadeIn();
					 },
					 error: function(errormessage) {
						  alert('Sendmail failed possibly php script: ' + errormessage);
					 }
				});
  });
  
  $('#apagar_resp').on('click', function(){
	  var data = 'aa';
				$.ajax({
					 type: "POST",
					 url: "pedidos/apaga_respostas/s-<?=$tokensala;?>",
					 data: data,
					 success: function(phpReturnResult){
						  alert('Respostas apagadas!'); 
						  $('#apagar_resp').fadeOut(); 
					 },
					 error: function(errormessage) {
						  alert('Sendmail failed possibly php script: ' + errormessage);
					 }
				});
  });
  
  $('#voltar').on('click', function(){
	 	var irPara 	= $(this).attr('ir-para');
		var data	= 'partenova=' + irPara + '&comando=0';
		var t_total = <?=$trasntot;?>;
		
		if(irPara != 0){
				$.ajax({
					 type: "POST",
					 url: "pedidos/atualiza_parte/s-<?=$tokensala?>",
					 data: data,
					 success: function(phpReturnResult){
						  if(irPara < t_total){
							$('#avancar').fadeIn(); 
						 }
						 if(irPara == 1){
							$('#voltar').fadeOut();
						 }
					 },
					 error: function(errormessage) {
						  alert('Sendmail failed possibly php script: ' + errormessage);
					 }
				});
		}
  });
  
  $('#avancar').on('click', function(){
	 	var irPara 	= $(this).attr('ir-para');
		var data	= 'partenova=' + irPara + '&comando=0';
		var t_total = <?=$trasntot;?>;
		
		if(irPara <= <?=$trasntot;?>){
				$.ajax({
					 type: "POST",
					 url: "pedidos/atualiza_parte/s-<?=$tokensala?>",
					 data: data,
					 success: function(phpReturnResult){
						 if(irPara == t_total){
							$('#avancar').fadeOut(); 
						 }
						 if(irPara > 1){
							$('#voltar').fadeIn(); 
						 }
					 },
					 error: function(errormessage) {
						  alert('Sendmail failed possibly php script: ' + errormessage);
					 }
				});
		}
  });
</script>
</body>
</html>
<?php } ?>
