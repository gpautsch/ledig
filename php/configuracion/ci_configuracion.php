<?php
class ci_configuracion extends ledig_ci
{
	// CONTROLADOR DE INTERFAZ: configuración
	// #Tarea 853
	// Se incorpora una Interfaz Configuración 
	// posibilidad de cambiar parámetros de servidor del file system

	function ini__operacion()
	{
		$this->dep('datos')->cargar();
	}

	function evt__guardar()
	{
		$this->dep('datos')->sincronizar();
		$this->dep('datos')->resetear();
		$this->dep('datos')->cargar();
	}

	function evt__formulario__modificacion($datos)
	{
		$this->dep('datos')->procesar_filas($datos);
	}

	function conf__formulario(toba_ei_formulario_ml $componente)
	{
		$componente->set_datos($this->dep('datos')->get_filas());
	}

}

?>