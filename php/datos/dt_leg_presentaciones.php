<?php
class dt_leg_presentaciones extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if (isset($filtro['dni'])) {
			$where[] = "dni = ".quote($filtro['dni']);
		}
		$sql = "SELECT
			t_lp.id_presentacion,
			t_lp.fecha,
			t_lp.dni,
			D.id_dep,
			D.depositario,
			t_lp.url_pdf,
			TD.tipo_doc,
			TD.descripcion,
			t_lp.copydoc
		FROM
			leg_presentaciones as t_lp
		LEFT JOIN leg_depositarios D ON D.id_dep = t_lp.id_dep
		LEFT JOIN leg_tipo_doc TD ON TD.tipo_doc = t_lp.id_tipo_doc
			ORDER BY 1";
		if (count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('ledig')->consultar($sql);
	}

	function get_descripciones()
	{
		$sql = "SELECT id_presentacion, dni FROM leg_presentaciones ORDER BY dni";
		return toba::db('ledig')->consultar($sql);
	}

}
?>