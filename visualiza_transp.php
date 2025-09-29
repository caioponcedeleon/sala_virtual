<?php
include('conectar.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Visualizar</title>
<link type="text/css" rel="stylesheet" href="estilo.css" media="all">
<script src="jquery.min.js"></script>
</head>

<body>
<table border="0" width="90%" align="center"><tr><td>
<div class="tab_redonda_scor" style="height:500px;overflow:hidden; background-color:#FFF;">
<div style="width:98%;max-height:95% !important;overflow-y:auto;border-radius: 10px 10px 10px 10px;padding:10px;overflow-x:hidden;">

<?php
	$tinha = array('&', '<', '>', '"');
	$tenha = array("&amp;", "&lt;", "&gt;", '&quot;');
	
	
	$especial_vem = array('§', '₢', '¤');
	$especial_fic = array('&', '#', '+');
	
if(!isset($_GET['mostra'])){
	//========= VISUALIZAÇÃO ENQUANTO CRIA/EDITA

$dado1 = str_replace($especial_vem, $especial_fic, $_GET['a']);

echo str_replace($tenha, $tinha, $dado1);
	//========= MOSTRA SE FOR EXERCÍCIO
	if(isset($_GET['b'])){
				if($_GET['b'] == 2){
					$tamanho = '100px';	
				}else{
					$tamanho = '80%';
				}
				
				$varc_1 = str_replace($especial_vem, $especial_fic, $_GET['c']);

				$varc_2 = str_replace($tenha, $tinha, $varc_1);
				
				$exptxt		= explode('|', $varc_2);
				
				$conttxt	= count($exptxt);
				
				$textofinal = '';
				
				$aa = 0;
				foreach($exptxt as $texti){
					$aa++;
					if($aa != $conttxt){
						$textofinal .= $texti . ' <input name="resp'.$aa.'" required="required" style="width:'.$tamanho.';" type="text" autocomplete="off" class="estilo1" id="resp'.$aa.'" />';
					}else{
						$textofinal .= $texti;
					}
				}
				
				$envia		= '<p><div id="exercicio"><form id="enviaex" method="post"><input type="hidden" name="sala" value=""><input type="hidden" name="parte" value=""><input type="hidden" name="nresp" value=""><input type="hidden" name="respreal" value="">' . $textofinal . '</form><p align="center"><a class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;" id="enviarfinal"><span>Enviar respostas</span></a></p></div></p>';
				echo str_replace($tenha,$tinha,$envia);	
	}
}else{
	//========= VISUALIZAÇÃO NORMAL
	$token = $_GET['t'];
	
	$tinha = array("'", '"', "’", "“", "”", '‘', '’');
	$tenha = array("&#39;", "&quot;","&#39;", "&ldquo;", "&rdquo;", "&#39;", "&#39;");
		
		$transpeg	= $mysqli->query("SELECT * FROM transp WHERE toktra_tra = '$token'");
		$transpeginf= $transpeg->fetch_array();	
		
		if($transpeginf['tipo_tra'] == 1){
			echo str_replace($tenha,$tinha,$transpeginf['cont_tra']);
		}else{
				$expcont	= explode('§', $transpeginf['cont_tra']);
				
				if($expcont[2] == 2){
					$tamanho = '100px';	
				}else{
					$tamanho = '80%';
				}
				$exptxt		= explode('|', $expcont[3]);
				
				$conttxt	= count($exptxt);
				
				$textofinal = '';
				
				$aa = 0;
				foreach($exptxt as $texti){
					$aa++;
					if($aa != $conttxt){
						$textofinal .= $texti . ' <input name="resp'.$aa.'" required="required" style="width:'.$tamanho.';" type="text" autocomplete="off" class="estilo1" id="resp'.$aa.'" />';
					}else{
						$textofinal .= $texti;
					}
				}
				
				$envia		= $expcont[0] . '<p><div id="exercicio"><form id="enviaex" method="post"><input type="hidden" name="sala" value=""><input type="hidden" name="parte" value=""><input type="hidden" name="nresp" value=""><input type="hidden" name="respreal" value="'.$expcont[4].'">' . $textofinal . '</form><p align="center"><a class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;" id="enviarfinal"><span>Enviar respostas</span></a></p></div></p>';
				echo str_replace($tenha,$tinha,$envia);
			
		}
}
?>
</div>
</div>
</td></tr></table>
</body>
</html>