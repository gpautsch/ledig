<?php
	include ('datos/dao_ledig.php');
	//$ruta_izq = '/var/www/toba2.4/proyectos/expediente/www/';
	$server = toba::db('ledig')->consultar("select sp_get_local()");
	$ruta_izq = $server[0]["sp_get_local"] . "/";

	//ACTUALIZAR
	$file = $ruta_izq.$_GET['file'];//$_SERVER['DOCUMENT_ROOT'].$file;

//		$file = "/tmp/doc.pdf";

		if (file_exists($file)) {
//		    print_r("LOCAL: " . $file);die();			
			//ei_arbol(toba::memoria()->get_dato_instancia('pila_ejecucion'), 'pila');
			
			$url = $_SERVER['HTTP_REFERER'];


			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Type: application/force-download');
			
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			//ob_clean();
			flush();
			readfile($file);
			exit;
		}else{

			$server = toba::db('ledig')->consultar("select sp_get_server()");
			$ruta_izq = $server[0]["sp_get_server"] . "/";
			$url = $ruta_izq.$_GET['file'];//$_SERVER['DOCUMENT_ROOT'].$file;
			//if (url_exists($url))
			if (testServidor($url))
			{
//			    print_r("ONLINE: " . $url);die();
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Type: application/force-download');
				
				header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				//ob_clean();
				flush();
				readfile($url);
				exit;


			} else {
			      print_r("OOFFFFF" . $url);die();
			}
			//echo "No se encuentra el documento.";
		}


function testServidor($servidor) {
        $a = @get_headers($servidor);
        if (is_array($a)) {
            return true;
        } else {
            return false;
        }
  }


function url_exists( $url = NULL ) {
 
    if( empty( $url ) ){
        return false;
    }
 
    $options['http'] = array(
        'method' => "HEAD",
        'ignore_errors' => 1,
        'max_redirects' => 0
    );
    $body = @file_get_contents( $url, NULL, stream_context_create( $options ) );
    
    // Ver http://php.net/manual/es/reserved.variables.httpresponseheader.php
    if( isset( $http_response_header ) ) {
        sscanf( $http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode );
 
        // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array( 200, 301, 302 );
        if( in_array( $httpcode, $accepted_response ) ) {
            return true;
        } else {
            return false;
        }
     } else {
         return false;
     }
}

?>