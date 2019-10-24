<?php
class dt_leg_cont_presentacion extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if (isset($filtro['dni'])) {
			$where[] = "dni = ".quote($filtro['dni']);
		}
		$sql = "SELECT
			t_lcp.id_presentacion,
			t_lcp.dni,
			t_ltd.descripcion,
			t_lcp.cumplido,
			t_lcp.id_cont_presentacion,
			t_lcp.fecha
		FROM
			leg_cont_presentacion as t_lcp,
			leg_tipo_doc as t_ltd
		WHERE
			t_lcp.tipo_doc = t_ltd.tipo_doc
		ORDER BY 3";
		if (count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('ledig')->consultar($sql);
	}

}

?>
