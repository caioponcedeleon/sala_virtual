<?php
include('conectar.php');

	$tinha = array("'", '"', "\n", "’", "“", "”", '‘', '’');
	$tenha = array("&#39;", "&quot;", "<br>","&#39;", "&ldquo;", "&rdquo;", "&#39;", "&#39;");

switch($_GET['p']){
//================= CHECA MUDANÇAS - SALA ALUNO
	case 'checa_mudancas':
		$toksala = $_GET['s'];
		
		$checacod	= $mysqli->query("SELECT * FROM sala WHERE tok_sala = '$toksala'");
		$ncodok		= $checacod->fetch_array();			
		
		$passa		= array('trasp' => $ncodok['parte_sala'], 'varia' => $ncodok['coman_sala']);
		
		echo json_encode($passa);
	break;
	//================= PEGA INFOS (SLIDE ANTERIOR) - SALA ALUNO
	case 'pega_info_t_a':
		$toksala = $_GET['s'];
		
		$checacod	= $mysqli->query("SELECT * FROM sala WHERE tok_sala = '$toksala'");
		$ncodok		= $checacod->fetch_array();
		
		$tokapre	= $ncodok['apre_sala'];
		$ntrasp		= $ncodok['parte_sala'] - 1;
		
		$checatrapt	= $mysqli->query("SELECT * FROM transp WHERE tok_tra = '$tokapre'");
		$ntottrap	= $checatrapt->num_rows;			
		
		if($ntrasp <= 0){			
		
			$passa		= array('html' => '<p align="center">esta é a primeira transparência</p>');	
					
		}else{
			$transpeg	= $mysqli->query("SELECT * FROM transp WHERE tok_tra = '$tokapre' AND n_tra = '$ntrasp'");
			$transpeginf= $transpeg->fetch_array();	
			
			if($transpeginf['tipo_tra'] == 1){
				$passa		= array('html' => str_replace($tenha,$tinha,$transpeginf['cont_tra']));
			}else{
				$expcont	= explode('§', $transpeginf['cont_tra']);
				
				if($expcont[2] == 2){
					$tamanho = '10px';	
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
				$passa		= array('html' => str_replace($tenha,$tinha,$envia));
			
		}
		}
		
		echo json_encode($passa);
			
	break;		
	//================= PEGA INFOS (SLIDE POSTERIOR) - SALA ALUNO
	case 'pega_info_t_p':
		$toksala = $_GET['s'];
		
		$checacod	= $mysqli->query("SELECT * FROM sala WHERE tok_sala = '$toksala'");
		$ncodok		= $checacod->fetch_array();
		
		$tokapre	= $ncodok['apre_sala'];
		$ntrasp		= $ncodok['parte_sala'] + 1;
		
		$checatrapt	= $mysqli->query("SELECT * FROM transp WHERE tok_tra = '$tokapre'");
		$ntottrap	= $checatrapt->num_rows;			
		
		if($ntrasp > $ntottrap){			
		
			$passa		= array('html' => '<p align="center">esta é a última transparência</p>');	
					
		}else{
			$transpeg	= $mysqli->query("SELECT * FROM transp WHERE tok_tra = '$tokapre' AND n_tra = '$ntrasp'");
			$transpeginf= $transpeg->fetch_array();	
			
			if($transpeginf['tipo_tra'] == 1){
				$passa		= array('html' => str_replace($tenha,$tinha,$transpeginf['cont_tra']));
			}else{
				$expcont	= explode('§', $transpeginf['cont_tra']);
				
				if($expcont[2] == 2){
					$tamanho = '10px';	
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
				$passa		= array('html' => str_replace($tenha,$tinha,$envia));
			
		}
		}
		
		echo json_encode($passa);
			
	break;	
	//================= ATUALIZA PARTICIPANTE
	case 'atualiza_participante':
		$toksala = $_GET['s'];
		
		$nome	 = $_POST['nome'];
		
		$agora   = date('Y-m-d H:i:s');
		
		$mysqli->query("UPDATE online SET ultimo_on='$agora' WHERE sala_on = '$toksala' AND nome_on = '$nome'");
		
	break;
	//================= PEGA INFOS PARTICIPANTES - PROFESSOR
	case 'checa_participantes_p':
		$toksala = $_GET['s'];
		
		$checape	= $mysqli->query("SELECT * FROM online WHERE sala_on = '$toksala' ORDER BY id_on");
		$nparts		= $checape->num_rows;
		
		if($nparts == 0){
			
			$html = 'Não há nenhum participante nas sala!';
			
			$passa		= array('html' => $html);
		}else{
			$pessoas = '';
			$i = 0;
			while($infope = $checape->fetch_array()){
				
				$agoramais = date('Y-m-d H:i:s', strtotime('-10 seconds'));	
				$agoradelt = date('Y-m-d H:i:s', strtotime('-10 minutes'));				
				if(strtotime($infope['ultimo_on']) > strtotime($agoramais)){
				$i++;
					$pessoas .= '<div class="tab_redonda_scor"><img src="user.png" width="30" style="vertical-align:middle;"> <strong>'.$infope['nome_on'].'</strong></div><p>';
				}else{
					if(strtotime($infope['ultimo_on']) < strtotime($agoradelt)){
						$nome_del = $infope['nome_on'];
						$mysqli->query("DELETE FROM online WHERE sala_on = '$toksala' AND nome_on = '$nome_del'");
					}
				}
			}
			if($i > 0){
				$passa		= array('html' => $pessoas);
			}else{
				$html = 'Não há nenhum participante nas sala!';
				$passa		= array('html' => $html);
			}
			
		}
		
		echo json_encode($passa);
			
	break;	
	//================= PEGA INFOS PARTICIPANTES
	case 'checa_participantes':
		$toksala = $_GET['s'];
		
		$checape	= $mysqli->query("SELECT * FROM online WHERE sala_on = '$toksala' ORDER BY id_on");
		$nparts		= $checape->num_rows;
		
		if($nparts == 0){
			
			$html = 'Não há nenhum participante nas sala!';
			
			$passa		= array('html' => $html);
		}else{
			$pessoas = '<table width="100%" cellpadding="10"><tr>';
			$i = 0;
			while($infope = $checape->fetch_array()){
				
				$agoramais = date('Y-m-d H:i:s', strtotime('-10 seconds'));				
				if(strtotime($infope['ultimo_on']) > strtotime($agoramais)){
				$i++;
					$pessoas .= '<td width="20%" align="center"><div class="tab_redonda_scor"><img src="user.png" width="30" style="vertical-align:middle;"> <strong>'.$infope['nome_on'].'</strong></div></td>';
				}
				if($i % 5 == 0){ echo '</tr></tr>'; }
			}
			$pessoas .= '</tr></table>';
			if($i > 0){
				$passa		= array('html' => $pessoas);
			}else{
				$html = 'Não há nenhum participante nas sala!';
				$passa		= array('html' => $html);
			}
			
		}
		
		echo json_encode($passa);
			
	break;				
	//================= PEGA INFOS - SALA ALUNO
	case 'pega_info_t':
		$toksala = $_GET['s'];
		if(isset($_GET['usu'])){
			$usu = $_GET['usu'];	
		}else{
			$usu = '';
		}
		
		$checacod	= $mysqli->query("SELECT * FROM sala WHERE tok_sala = '$toksala'");
		$ncodok		= $checacod->fetch_array();
		
		$tokapre	= $ncodok['apre_sala'];
		$ntrasp		= $ncodok['parte_sala'];
		
		$transpeg	= $mysqli->query("SELECT * FROM transp WHERE tok_tra = '$tokapre' AND n_tra = '$ntrasp'");
		$transpeginf= $transpeg->fetch_array();	
		
		if($transpeginf['tipo_tra'] == 1){
			$passa		= array('html' => str_replace($tenha,$tinha,$transpeginf['cont_tra']));
		}else{
	//================== MOSTRA EXERCICIO PARA RESPONDER
			if($ncodok['coman_sala'] == 0){
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
				$envia		= $expcont[0] . '<p><div id="exercicio"><form id="enviaex" method="post"><input type="hidden" name="sala" value="'.$toksala.'"><input type="hidden" name="parte" value="'.$ntrasp.'"><input type="hidden" name="nresp" value="'.$conttxt.'"><input type="hidden" name="usu" value="'.$usu.'"><input type="hidden" name="respreal" value="'.$expcont[4].'">' . $textofinal . '</form><p align="center"><a class="buttonnocor" style="vertical-align:middle; background-color:#D5B203;width:50%;" id="enviarfinal"><span>Enviar respostas</span></a></p></div></p><script>$("#enviarfinal").on("click",function(){	var meuForm = document.getElementById("enviaex");
	 var fd = new FormData(meuForm); $.ajax({ url: "pedidos/salvar_resposta", data: fd, cache: false, processData: false,   contentType: false, type: "POST", success: function (dataofconfirm) { $("#exercicio").html("<p align=center><b>Respostas enviadas!</b></p><p align=center>Agora espere a nova instrução!</p>"); $("#enviarfinal").fadeOut();      }    });  });</script>';
				$passa		= array('html' => str_replace($tenha,$tinha,$envia));
			}else{
	//======================== MOSTRA AS RESPOSTAS
	
			$expcont	= explode('§', $transpeginf['cont_tra']);
			
			if($expcont[2] == 2){
				$tamanho = '100px';	
			}else{
				$tamanho = '80%';
			}
			$exptxt		= explode('|', $expcont[3]);
			
			$expresp	= explode(';', $expcont[4]);
			
			//==== RESPOSTAS
			if($usu != ''){
				$usuresps	= $mysqli->query("SELECT * FROM respostas WHERE usu_resp='$usu' AND apre_resp='$toksala'");
				$respsinfo  = $usuresps->fetch_array();	
				
				$exprespsusu = explode('|', $respsinfo['resp_resp']);
				$expusudaa	 = explode(';', $exprespsusu[0]);
			}
			
			$conttxt	= count($exptxt);
			
			$textofinal = '';
			
			$aa = 0;
			foreach($exptxt as $texti){
				$aa++;
				if($aa != $conttxt){
					$textofinal .= $texti . ' <font color="#2EDA5C"><b>'.$expresp[$aa-1].'</b></font> ';
					if($usu != ''){ $textofinal .=  '<strong>[' . $expusudaa[$aa-1] . ']</strong>'; }
				}else{
					$textofinal .= $texti;
				}
			}
			
			$envia		= $expcont[0] . '<p>' . $textofinal;
			$passa		= array('html' => str_replace($tenha,$tinha,$envia));
			}
		}		
	
		echo json_encode($passa);
	break;
	//================= CHECA RESPOSTA - PROFESSOR
	case 'checa_respostas':
	
		$salatok = $_GET['s'];
		
		$checacod	= $mysqli->query("SELECT * FROM respostas WHERE apre_resp = '$salatok'");
		$checan		= $checacod->num_rows;
		
		if($checan == 0){
			$passa = array('html' => 'Sem respostas');	
		}else{
			$respostaspassa = '';
			while($ncodok = $checacod->fetch_array()){
				$expresp = explode('|',$ncodok['resp_resp']);
					$respostaspassa .= '<hr><b>'.$ncodok['usu_resp'] . ' enviou:</b> ' . $expresp[0] . '<p><strong>As respostas corretas eram:</strong> '.$expresp[1] . '<hr />';
			}
			$passa = array('html' => $respostaspassa);
		}		
		
		echo json_encode($passa);
		
	break;
	//================= SALVAR RESPOSTA - ALUNO
	case 'salvar_resposta':
		$sala	= $_POST['sala'];
		$parte	= $_POST['parte'];
		$nresp	= $_POST['nresp'];
		$usu	= $_POST['usu'];
		
		$respf	= '';
		foreach(range(1,$nresp) as $i){
			$esta_resp = 'resp' . $i;	
			
			$respf .= $_POST[$esta_resp] . ';';
		}
		
		$salvar = rtrim($respf, ';') . '|'. $_POST['respreal'];
		
		$mysqli->query("INSERT INTO respostas VALUES(null,'$usu','$sala','parte ".$nresp."','$salvar')");
		
	break;
	//================= ATUALIZA PARTE - PROFESSOR
	case 'atualiza_parte':
	
		$novaparte = $_POST['partenova'];
		$novocoman = $_POST['comando'];
		$toksala   = $_GET['s'];
		
		if($mysqli->query("UPDATE sala SET parte_sala = '$novaparte', coman_sala='$novocoman' WHERE tok_sala = '$toksala'")){
				echo 'sucesso';
		}else{
				echo 'erro';
		}
	break;
	//================= ATUALIZA COMANDO - PROFESSOR
	case 'atualiza_comando':
	
		$novocoman = $_POST['comando'];
		$toksala   = $_GET['s'];
		
		if($mysqli->query("UPDATE sala SET coman_sala = '$novocoman' WHERE tok_sala = '$toksala'")){
				echo 'sucesso';
		}else{
				echo 'erro';
		}
	break;
	//================= APAGA RESPOSTAS - PROFESSOR
	case 'apaga_respostas':
	
		$novocoman = $_POST['comando'];
		$toksala   = $_GET['s'];
		
		if($mysqli->query("DELETE FROM respostas WHERE apre_resp = '$toksala'")){
				echo 'sucesso';
		}else{
				echo 'erro';
		}
	break;
}
?>