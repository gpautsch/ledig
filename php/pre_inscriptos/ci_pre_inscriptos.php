<?php
include ('datos/dao_ledig.php');
class ci_pre_inscriptos extends toba_ci
{
	//CONTROLADOR DE INTERFAZ: pre_inscriptos

	//Para guardar y aplicar las preferencias de filtro
	protected $s__datos_filtro;


	//---- Filtro -----------------------------------------------------------------------

	function conf__filtro(toba_ei_formulario $filtro)
	{
		if (isset($this->s__datos_filtro)) {
			$filtro->set_datos($this->s__datos_filtro);
		}
	}

	function evt__filtro__filtrar($datos)
	{
		if (array_no_nulo($datos)) {
			$this->s__datos_filtro = $datos;
		} else { 
			toba::notificacion()->agregar('El filtro no posee valores');
		}
	}

	function evt__filtro__cancelar()
	{
		unset($this->s__datos_filtro);
	}

	//---- Cuadro -----------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
		if (isset($this->s__datos_filtro)) {
			$cuadro->set_datos($this->dep('datos')->tabla('sga_preinscripcion')->get_listado($this->s__datos_filtro));
		}
	}

	function evt__cuadro__seleccion($datos)
	{
		$this->dep('datos')->cargar($datos);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__import($seleccion)
	{ 	
		$import = dao_ledig::import_legajo($seleccion['id_preinscripcion']);
		if ($import){
			toba::notificacion()->info("El registro se importo con exito");
		}else{
			toba::notificacion()->info("El registro YA fue importado");
		}
	}


	//---- Formulario -------------------------------------------------------------------

	function conf__formulario(toba_ei_formulario $form)
	{
		if ($this->dep('datos')->esta_cargada()) {
			$form->set_datos($this->dep('datos')->tabla('sga_preinscripcion')->get());
		} else {
			$this->pantalla()->eliminar_evento('eliminar');
		}
	}

	function evt__formulario__modificacion($datos)
	{
		$this->dep('datos')->tabla('sga_preinscripcion')->set($datos);
	}

	function resetear()
	{
		$this->dep('datos')->resetear();
		$this->set_pantalla('pant_seleccion');
	}

	//---- EVENTOS CI -------------------------------------------------------------------

	function evt__agregar()
	{
		$this->set_pantalla('pant_edicion');
	}

	function evt__volver()
	{
		$this->resetear();
	}

	function evt__eliminar()
	{
		$this->dep('datos')->eliminar_todo();
		$this->resetear();
	}

	function evt__guardar()
	{
		$this->dep('datos')->sincronizar();
		$this->resetear();
	}

	function conf()
	{
		//#Tarea 853
		// Mejora en la navegación cuando se va o vuelve de una pantalla Legajos,
		// mantiene los datos anteriores en la pre visualización del cuadro
		$dato = toba::memoria()->get_dato_sincronizado($id_pre);
		if (array_no_nulo($dato)) {
			$this->s__datos_filtro = $dato;
		}
	}
}
?>
