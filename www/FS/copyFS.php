<?php
//------Tareas #887 ------------
/* ESQUE SCRIPT GENERA EN ARCHIVO scriptFS.sh CON LOS COMANDOS NECESARIOS PARA LUEGO
 EJECUTARLOS DESDE EL PLANIFICADOR DE TAREAS Y ASI COMPIAR LOS PDF GENERADOS DESDE 
 EL NODO MAESTRO AL NODO SEDE
**/
$conexion_bd = pg_pconnect('host=' . PGHOST . ' port=' . PGPORT . ' dbname=' . PGDATABASE . ' user=' . PGUSER . ' password=' . PGPASSWORD)
or die('No pudo conectarse: ' . pg_last_error());

//SQL CON PRESENTACIONES QUE RESTEN COPIAR (ATRIBUTO copydoc='false')
$query = "SELECT url_pdf, id_presentacion FROM leg_presentaciones WHERE copydoc = 'false' AND url_pdf <> ''";
$dataset = pg_query($query);
$path = PATH; // "#/toba_2.7.13/proyectos/ledig/www/";
$server = "USUARIO@DIR_IP_SERVER_SEDE";
$comando = "";
$archivo = fopen("scriptFS.sh", "a");
while ($row=pg_fetch_row($dataset))
{
        list($dir,$cohorte,$dni,$file)=explode("/",$row[0]);
        $origen = $path . $row[0]; 
        // Antes se copiar se genera comando para forzar creación directorio en el server remoto
        $comando = $comando . "ssh " . $server . " mkdir " . $path . $dir ."/".$cohorte."/".$dni . PHP_EOL;
		// copydoc en true. Si se necesita, luego desde la aplicación el administrador 
		// puede cambiar esta bandera para para volver a forzar el copiado del pdf faltante
		$query = "UPDATE leg_presentaciones SET copydoc = 'true' where id_presentacion = " . $row[1];
        pg_query($query);
		if (pg_query($query) <> false) {
			//Con Compresion y detalle log (-Cv)
            $comando = $comando . "scp -Cv ". $origen . " " . $server .":". $path . $dir ."/".$cohorte."/".$dni."/". $file . PHP_EOL;
		}
		fwrite($archivo, $comando);
}
fclose($archivo);
?>


