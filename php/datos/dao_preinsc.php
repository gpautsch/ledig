<?php
class dao_preinsc
{

	function get_regpre($idpre)
	{
		// Guardo en la variable $regpre  el registro de pre inscripcion seleccionado en el cuadro
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
//		return $regpre;
	}

	function get_periodo_insc($carrera)
	{
		// Obtengo ultimo año de periodo de preinsc activo
		return toba::db('preinsc_v270')->consultar("
			SELECT max(periodo_inscripcio) as periodo 
			FROM sga_periodos_prein WHERE carrera = '" . $carrera . "'");
	}

	
}
?>
