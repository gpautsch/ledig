<?php
class dt_sga_preinscripcion extends toba_datos_tabla
{

		function get_descripciones()
		{
			$sql = "SELECT id_preinscripcion, usuario FROM sga_preinscripcion ORDER BY usuario";
			return toba::db('ledig')->consultar($sql);
		}


	function get_nombre_presentacion()
	{
		$sql = "SELECT DISTINCT
				sga_preinscripcion.id_preinscripcion, 
					sga_preinscripcion.apellido || ' - ' ||   sga_preinscripcion.nombres nombre
			FROM 
				public.sga_preinscripcion INNER JOIN  public.leg_presentaciones
				ON  leg_presentaciones.id_preinscripcion = sga_preinscripcion.id_preinscripcion";
		return toba::db('ledig')->consultar($sql);
	}




	function get_listado($filtro=array())
	{
		$where = array();
		if (isset($filtro['carrera'])) {
			$where[] = "carrera = ".quote($filtro['carrera']);
		}
		if (isset($filtro['apellido'])) {
			$where[] = "apellido ILIKE ".quote("%{$filtro['apellido']}%");
		}
		if (isset($filtro['dni'])) {
			$where[] = "nro_documento = ".quote($filtro['dni']);
		}
	

				$sql= "SELECT
						P.id_preinscripcion,
						C.carrera,
						A.nombre_reducido,
						A.nombre,
						P.estado,
						apellido,
						nombres,
						P.tipo_documento,
						nro_documento
					FROM
						sga_preinscripcion P 
						LEFT JOIN sga_carreras_insc C ON P.id_preinscripcion = C.id_preinscripcion
						LEFT JOIN sga_carreras A ON A.carrera = C.carrera
					";
	
		
		
		
/*        $sql= "SELECT
			P.id_preinscripcion,
			carrera,
			P.estado,
			apellido,
			nombres,
			P.tipo_documento,
			nro_documento
			FROM
				sga_preinscripcion P LEFT JOIN sga_carreras_insc C 
				ON P.id_preinscripcion = C.id_preinscripcion";
	*/      
		
		if (count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('preinsc_v270')->consultar($sql);
	}





}
?>