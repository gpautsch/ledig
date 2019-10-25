<?php
include ('datos/dao_ledig.php');
class ci_legajos extends toba_ci
{
	//CONTROLADOR DE INTERFAZ: legajos (metadatos)

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
			$cant = count($this->dep('datos')->tabla('ledig')->get_listado($this->s__datos_filtro));
			if ($cant > 0) {
				$cuadro->set_datos($this->dep('datos')->tabla('ledig')->get_listado($this->s__datos_filtro));
			} else {
				// Si NO se encuentra el legajo, ofrece importarlo desde la BD de pre inscripción 
				toba::notificacion()->info("El registro no existe !!! <br>Pruebe importarlo desde el sistemas de Pre Inscripcion utilizando el boton: <strong>Recuperar Pre Insc</strong>");
			}

		}
	}

	function evt__cuadro__eliminar($datos)
	{
		$this->dep('datos')->resetear();
		$this->dep('datos')->cargar($datos);
		$this->dep('datos')->eliminar_todo();
		$this->dep('datos')->resetear();
	}

	function evt__cuadro__seleccion($datos)
	{
		$this->dep('datos')->cargar($datos);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__presentacion($seleccion)
	{
		$this->dep('datos')->cargar($seleccion);
		$reg = dao_ledig::get_legajo_dni($seleccion['dni']);
		if ($reg[0]['cohorte'] <> null) {
			toba::memoria()->set_dato_sincronizado($dni,$seleccion);
			toba::vinculador()->navegar_a(toba::proyecto()->get_id(),'542000056');
		} else {
			toba::notificacion()->info("Configurar Cohorte !!! <br>Actualice la <strong>cohorte</strong> del legajo antes de adjuntar una presentacion");
		}
    }

	//---- Formulario -------------------------------------------------------------------

	function conf__formulario(toba_ei_formulario $form)
	{
		if ($this->dep('datos')->esta_cargada()) {
			$form->set_datos($this->dep('datos')->tabla('ledig')->get());
		///  Preview Foto
			$datos = $this->dep('datos')->tabla('ledig')->get();
			$fp_imagen = $this->dep('datos')->tabla('ledig')->get_blob('foto');
			if (isset($fp_imagen)) {

					//-- Se necesita el path fisico y la url de una archivo temporal que va a contener la imagen
					$temp_nombre = md5(uniqid(time()));
					$temp_archivo = toba::proyecto()->get_www_temp($temp_nombre);
			
					//-- Se pasa el contenido al archivo temporal
					$temp_fp = fopen($temp_archivo['path'], 'w');
					stream_copy_to_stream($fp_imagen, $temp_fp);
					fclose($temp_fp);
					$tamano = round(filesize($temp_archivo['path']) / 1024);
					
					//-- Se muestra la imagen temporal
					$datos['foto'] = "<img src='{$temp_archivo['url']}' alt=''>";
					$datos['upfoto'] = 'Imagen: '.$tamano. ' KB';
			} else {
				$datos['imagen'] = null;
			}
			return $datos;
		/// Fin Preview
		} else {
			$this->pantalla()->eliminar_evento('eliminar');
		}
	}

	function evt__formulario__modificacion($datos)
	{
		$this->dep('datos')->tabla('ledig')->set($datos); 
		// Para guardar la imagen
		if (is_array($datos['upfoto'])) {
			$fp = fopen($datos['upfoto']['tmp_name'], 'rb');
			$this->dep('datos')->tabla('ledig')->set_blob('foto', $fp);
			$datos['upfoto'] = $datos['upfoto']['tmp_name'].$datos['upfoto']['name'];
		}    

		$this->dep('datos')->tabla('ledig')->set($datos); 
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

	function evt__Recuperar()
	{
		//Llama al form pre insc para importar los datos del alumno;
		toba::memoria()->set_dato_sincronizado($id_pre,$this->s__datos_filtro);
		toba::vinculador()->navegar_a(toba::proyecto()->get_id(),'542000054');
	}

	function evt__cancelar()
	{
		$this->set_pantalla('pant_seleccion');
	}

	function conf()
	{
		$dato = toba::memoria()->get_dato_sincronizado($id_pre);
		if (array_no_nulo($dato)) {
			$this->s__datos_filtro = $dato;
		}
		$reg = $this->dependencia('formulario')->get_datos();
		//#Tarea 709
		// Bug Ledig - Modificación DNI y Cohorte
		if ($this->dep('datos')->esta_cargada()) {
			$this->dependencia('formulario')->set_solo_lectura('dni');
			if ($reg['cohorte'] <> null) {
				$this->dependencia('formulario')->set_solo_lectura('cohorte');
			}
		} 
	}
}
?>
