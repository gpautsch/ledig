<?php
class dt_ledig extends toba_datos_tabla
{
	//COMPONENTE DE INTERFAZ DATOS TABLA: ledig

	function get_listado($filtro=array())
	{
		// Se establacen preferencias de filtro en $where 
		$where = array();
		if (isset($filtro['dni'])) {
			$where[] = "dni = ".quote($filtro['dni']);
		}
		if (isset($filtro['legajo'])) {
			$where[] = "legajo = ".quote($filtro['legajo']);
		}
		if (isset($filtro['apellido'])) {
			$where[] = "apellido ILIKE ".quote("%{$filtro['apellido']}%");
		}
		$sql = "SELECT
			t_l.dni,
			t_l.legajo,
			t_l.unidad_academica,
			t_l.sede,
			c.nombre_reducido as carrera,
			t_l.estado,
			t_l.apellido,
			t_l.nombres,
			t_l.cohorte,
			t_l.foto
		FROM
			ledig as t_l
			INNER JOIN sga_carreras c ON c.carrera = t_l.carrera
		ORDER BY legajo";
		if (count($where)>0) {
			// Concatena a la sql las preferencias de filtro
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('ledig')->consultar($sql);
	}

		function get_descripciones()
		{
			$sql = "SELECT dni, legajo FROM ledig ORDER BY legajo";
			return toba::db('ledig')->consultar($sql);
		}

}
?>
