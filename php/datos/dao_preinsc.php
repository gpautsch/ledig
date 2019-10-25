<?php
class dao_preinsc
{
	//MANEJADOR DE DATOS: preinscripciones

	function get_regpre($idpre)
	{
		// Retorna el registro de pre inscripcion seleccionado en el cuadro
		return toba::db('preinsc_v270')->consultar("
			SELECT 
			  carrera, 
			  P.estado, 
			  apellido,
			  nombres,
			  sede,
			  unidad_academica,
			  P.nro_documento
			FROM 
			  sga_preinscripcion P, 
			  sga_carreras_insc C
			WHERE 
			  P.id_preinscripcion = C.id_preinscripcion 
			  AND  P.id_preinscripcion = " . $idpre  );
	}

	function get_periodo_insc($carrera)
	{
		// Obtiene el ultimo periodo de preinscripcion activo de esa $carrera
		return toba::db('preinsc_v270')->consultar("
			SELECT max(periodo_inscripcio) as periodo 
			FROM sga_periodos_prein WHERE carrera = '" . $carrera . "'");
	}

	
}
?>
