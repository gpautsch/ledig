<?php
class dt_sga_carrera extends toba_datos_tabla
{
	//COMPONENTE DE INTERFAZ DATOS TABLA: carreras

	function get_descripciones()
	{
		$sql = "SELECT carrera, nombre FROM sga_carreras";
		return toba::db('ledig')->consultar($sql);
	}
}
?>
