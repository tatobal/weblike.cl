<?php
	
	

	function enviarCorreo()
	{
		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$nombreSitio="Weblike";
//urlsitioweb
$urlSitio="http://www.weblike.cl";

$header = 'From: contacto@weblike.cl' . "\r\n" .
    	  'Reply-To: contacto@weblike.cl' . "\r\n" .
    	   'X-Mailer: PHP/' . phpversion();

$headers = 'From:'.$correo . "\r\n" .
    	  'Reply-To:' .$correo . "\r\n" .
    	   'X-Mailer: PHP/' . phpversion();


		$mensaje = "Este mensaje fue enviado por " . $nombre . " \r\n";
		$mensaje .= "Su Correo es: " . $correo . " \r\n";
		$mensaje .= "Mensaje: " . $_POST['mensaje'] . " \r\n";
		$mensaje .= "Enviado el " . date('d/m/Y', time());

$para = 'contacto@weblike.cl';
$asunto = 'Formulario Sitio Web';

$mensaje1 .= "Mensaje: " . $_POST['mensaje'] . " \r\n";

$para2=$correo;
$mensaje2	= "
Se han puesto en contacto mediante el formulario de 'CONTACTO' de nuestra pagina web weblike.cl. Los datos del usuario son:\n


Nombre: $nombre \n
		Correo: $correo \n
		$mensaje1 \n


Saludos
$nombreSitio
$urlSitio";

mail($para, $asunto, utf8_decode($mensaje), $header);
mail($para2, $asunto, utf8_decode($mensaje2), $header);
		echo '<script language="javascript">alert("Tu mensaje se ha enviado exitosamente");</script>'; 
		echo '<script language="javascript">window.location.href="index.html";</script>'; 
		
		
		
	}


	function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LdiuwgUAAAAAGsgu6tWUAfSbpJ9acLxNdG079zE',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Agregarmos una variable CaptCha
    $res = post_captcha($_POST['g-recaptcha-response']);

	// Fin Agregarmos una variable CaptCha


    // Comprobamos que el Captcha esté completo
        if (!$res['success']) {
        
        echo '<script language="javascript">alert("Favor de completar el reCaptcha para comprobar que no eres un spam");</script>'; 
        echo '<script language="javascript">window.location.href="contacto.html";</script>'; 
		
        }
        else{
        	enviarCorreo();
        }
        // Fin de comprobación Catpcha









        /*

		$recaptcha = $_POST['g-recaptcha-response'];

		if($recaptcha != ''){
			$secret = "6LdiuwgUAAAAAGsgu6tWUAfSbpJ9acLxNdG079zE";
			$ip = $_SERVER['REMOTE_ADDR'];
			$var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");
			$array = json_decode($var, true);
			if($array['success']){
				enviarCorreo();

			}
			else{
				echo "soy robot";
			}
		}
		else{
			echo '<script language="javascript">alert("Favor de completar todos los campos");</script>'; 
			echo '<script language="javascript">window.location.href="index.html";</script>';  

			}
		*/
?>



