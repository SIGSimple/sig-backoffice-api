<?php

	function baseUrl(){
		return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
	}

	function serverName(){
		return $_SERVER['SERVER_NAME'];
	}

	function removeMaskNumber($number){
		//$punctuation = preg_quote( "," );
		if( strstr($number,",")){
		$number = preg_replace( array("/[\(\)\- _\.R\$%]/","/[,]/"), array('','.'),$number);
		}
		return (float)$number;
	}

	function prepareWhere($busca){
		foreach ($busca as $key => $value) {
			$key = str_replace("->",'.',$key);
			if(is_array($value)){
				$aux[] = $key.' '.$value['exp'];
			}else{
				$aux[] = $key." = '$value'";
			}
		}
		return stripslashes(join(' AND ',$aux));
	}

	function parse_arr_values($arr,$arr_key=null,$tipo = null){
		$default_tipo = $tipo ;
		foreach ($arr as $key => $value) {
			if(is_array($value)){
				$arr[$key] = parse_arr_values($value,$arr_key,$tipo);	
			}else{
				if(!function_exists($tipo)){
					if($default_tipo == null){
						if(is_numeric($value))
							$tipo = 'double';
						elseif (is_null($value)) {
							$tipo = 'null';
						}
						else{
							$tipo = 'string';
						}
							
					}
					if($arr_key == 'all' || in_array($key, $arr_key)){
						switch($tipo){
							case 'float':
								$arr[$key] = (float)$value ;
								break;
							case 'int':
								$arr[$key] = (int)$value ;
								break;
							case 'double':
								$arr[$key] = (double)$value ;
								break;
							case 'string':
								$arr[$key] = (string)$value ;
								break;
							case 'null':
								$arr[$key] = null ;
								break;
						} 
					}
				}else{
					if($arr_key == 'all' || in_array($key, $arr_key)){
						$arr[$key] = $tipo($value) ;
					}
				}
			}
		}

		return $arr ;
	}

	function formateDateFY($value){
		$arrMonth     = array("Janeiro","Fevereiro","Marco","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
		$mes          = (int)date('m',strtotime($value));
		$ano          = date('Y',strtotime($value));
		return $arrMonth[$mes-1].'/'.$ano ;
	}

	function formateDateDMY($value){
		return date('d-m-Y',strtotime($value));
	}


	function ultimoDiaMes($data=""){
		if (!$data) {
			$dia = date("d");
			$mes = date("m");
			$ano = date("Y");
		} else {
			$dia = date("d",$data);
			$mes = date("m",$data);
			$ano = date("Y",$data);
		}

		$data = mktime(0, 0, 0, $mes, 1, $ano);
		return date("d",$data-1);
	}

	 function sendMail($assunto,$corpo,$destinatarios=array(0=>array("nome"=>"", "email"=>"")),$form_data=array()){
	        if(is_array($form_data)):
                //extract($form_data);
                foreach($form_data as $var=>$value):
                        ${"$var"} = $value;
                endforeach;
	        endif;

	        unset($form_data);

	        $mail = new PHPMailer();
	        $mail->IsSMTP();
	        $mail->IsHTML(true);
			$mail->CharSet = "text/html; charset=UTF-8;";
	        $mail->Host     = "mail.hageerp.com.br";                  
	        $mail->SMTPAuth = true;
	        $mail->Username = 'sistema@hageerp.com.br';
	        $mail->Password = 'hage@erp';
	        $mail->Port     = 587;
	        $mail->From     = 'sistema@hageerp.com.br';
	        $mail->Sender   = "sistema@hageerp.com.br";
	        $mail->FromName = 'HageERP'; 

	        foreach($destinatarios as $var=>$value):
	                $mail->AddAddress($value['email'], $value['nome']);
	        endforeach;

	        ob_start();
	                include("util/email_templates/".$corpo);
	                $body = ob_get_contents();
	        ob_end_clean();

	        $mail->Subject  = $assunto; 
	        $mail->Body 	= $body   ;
	       
	        $enviado = $mail->Send();

	        $mail->ClearAllRecipients();
	        $mail->ClearAttachments();

	        if ($enviado):
	                return true;
	        else:
	                return false;
	        endif;
    }

    function mascara_string($mascara,$string)
	{
	   $string = str_replace(" ","",$string);
	   for($i=0;$i<strlen($string);$i++)
	   {
	      $mascara[strpos($mascara,"#")] = $string[$i];
	   }
	   return $mascara;
	}

?>