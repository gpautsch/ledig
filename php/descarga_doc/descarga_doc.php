<?php
	/* #Tarea 887
	   ESTE SCRIPT SE ENCARGA DE ARMAR LA URL AL PDF, OCULTANDO LA MISMA
	   PARA QUE LA RUTA AL SISTEMA DE ARCHIVOS NO SE MUESTRE EN EL NAVEGADOR
	**/

	include ('datos/dao_ledig.php');
	//Obtiene Server Local (Ruta Izquierda de la URL)
	$server = toba::db('ledig')->consultar("select sp_get_local()");
	$ruta_izq = $server[0]["sp_get_local"] . "/";
	//Concatena la ruta del pdf en el sistema de archivos
	$file = $ruta_izq.$_GET['file'];
		if (file_exists($file)) {
			// Si existe el pdf en el server local, lo muetra
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
			flush();
			readfile($file);
			exit;
		}else{
			// Si el pdf no se encuentra en el Server Local en la Sede
			// Se realiza la busqueda en el nodo Maestro
			$server = toba::db('ledig')->consultar("select sp_get_server()");
			$ruta_izq = $server[0]["sp_get_server"] . "/";
			$url = $ruta_izq.$_GET['file'];
			if (testServidor($url))
			{
				copy($url,'/tmp/legajo.pdf');
				$file = '/tmp/legajo.pdf';
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Type: application/force-download');
				header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				flush();
				readfile($file);
				exit;
			} else {
			      print_r("NO es posible reuperar el archivo. Intenteló más tarde" . $url);
			      die();
			}
		}

// Verificar si el nodo $servidor esta activo
function testServidor($servidor) {
        $a = @get_headers($servidor);
        if (is_array($a)) {
            return true;
        } else {
            return false;
        }
  }

// Verifica si existe una url
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
