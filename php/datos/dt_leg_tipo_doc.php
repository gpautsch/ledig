<?php
class dt_leg_tipo_doc extends toba_datos_tabla
{
	//COMPONENTE DE INTERFAZ DATOS TABLA: tipo documentación (entregada por el alumno)

	function get_descripciones()
	{
		$sql = "SELECT tipo_doc, descripcion FROM leg_tipo_doc ORDER BY descripcion";
		return toba::db('ledig')->consultar($sql);
	}

	function get_tipo_doc($dni)
	{
		$sql = "SELECT tipo_doc, descripcion FROM leg_tipo_doc
		WHERE tipo_doc NOT in (SELECT id_tipo_doc FROM leg_presentaciones WHERE dni='". $dni ."')
		ORDER BY 2";
		return toba::db('ledig')->consultar($sql);
	}

}
?>
