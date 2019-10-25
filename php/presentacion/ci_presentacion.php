<?php
include ('datos/dao_ledig.php');
class ci_presentacion extends toba_ci
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
		$this->s__datos_filtro = $datos;
	}

	function evt__filtro__cancelar()
	{
		unset($this->s__datos_filtro);
	}

	//---- Cuadro -----------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
		if (isset($this->s__datos_filtro)) {
			$datos=$this->dep('datos')->tabla('leg_presentaciones')->get_listado($this->s__datos_filtro);
			if (!empty($datos)) {
				$cuadro->set_datos($this->creaLink($datos));
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

	//---- Formulario -------------------------------------------------------------------

	function conf__formulario(toba_ei_formulario $form)
	{
		if ($this->dep('datos')->esta_cargada()) {
			$form->set_datos($this->dep('datos')->tabla('leg_presentaciones')->get());
		} else {
			$miSet = $this->s__datos_filtro;
			$miSet['fecha'] = date("Y-m-d");
			$this->dependencia('formulario')->set_solo_lectura('dni');
			$this->dependencia('formulario')->set_datos($miSet);
			$this->pantalla()->eliminar_evento('eliminar');
		}
	}

	function evt__formulario__modificacion($datos)
	{

		$cohorte = dao_ledig::get_legajo_dni($datos['dni']);
		if (is_array($datos['url_pdf'])) {
			// #Tarea 853
			//Genera una marca con el proximo id de la tabla
			$stamp = toba::db('ledig')->consultar("SELECT nextval('leg_presentaciones_id_presentacion_seq') as now");
			// #Tarea 829
			// Se arma url + el sud dir cohorte y dni
		$url ='legajos/' .  $cohorte[0]['cohorte'] . '/' . $datos['dni'] . '/'; 
		$datos['url_pdf']['name'] = $stamp[0]['now'] . "_" . $datos['url_pdf']['name'];
		if (file_exists($url)) {  
			if (file_exists($url.$datos['url_pdf']['name'])) {  
				// Compruebo si existe el archivo
				// Renombrar archivo existente para que pueda subir el nuevo
				rename($url . $datos['url_pdf']['name'],$url . "_" . $datos['url_pdf']['name']);
			} 
		} else {
			// Si el directorio no existe, lo crea
			mkdir($url);
			// Para crear el mismo directorio en el nodo Esclavo
			//exec("ssh " . $serversede . " mkdir " . $fssede . $url);
		}
		// Realiza el upload del pdf al sistema de archivos
		if (copy($datos['url_pdf']['tmp_name'] , $url . $datos['url_pdf']['name'])){
			$datos["url_pdf"] = $url.$datos['url_pdf']['name'];
			}
		} else {
			unset($datos["url_pdf"]);
		}
		$this->dep('datos')->tabla('leg_presentaciones')->set($datos);

///-----Tareas #886-------------------
/*
		// EL COPIADO A LA SEDE SE DESHABILITA DEBIDO A LA DEMORA QUE GENERA
//        exec("scp ". $origen . " " . $serversede . ":" . $origen,$aux1,$aux2);
//        AGRAGADO PARA QUE SE ACTUALIZA EL FS EN NODO SD   
		  $origen = $fssede . $url . $dni . $archsede;
          if ($aux2 == 0) {
//            $query = "UPDATE leg_presentaciones SET copydoc = 'true' where id_presentacion = " . $row[1];
//             pg_query($query);
//        }else {
               $archivo = fopen("scriptFS.sh", "a");
                fwrite($archivo, "scp ". $origen . " " . $serversede . ":" . $origen);
                fclose($archivo);
//                }
**/
///---------------------------
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
		toba::memoria()->set_dato_sincronizado($id_pre,$this->s__datos_filtro);
		toba::vinculador()->navegar_a(toba::proyecto()->get_id(),'542000052');
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
	function creaLink($datos) { 
			//#Tarea 887
			//Genera el link al script descarga_doc para mostrar en el Cuadro
			$j=0;
			foreach($datos as $dato)        
			{
				$path_comprobante_corto = $dato["url_pdf"];
				// Toma el nombre del archivo
				$param = array('file'=> $path_comprobante_corto);
				$url = toba::vinculador()->get_url('ledig', '3464',$param);
				// Genera etiqueta para mostrar en el link
				$nombre_comprobante = 'Comprobante:'.$dato["descripcion"];
				$img = toba_recurso::imagen_proyecto('logo.gif',true,null,null,"Ver documento");
						$completo[$j]["url_pdf"]  = "<a href=# onclick='downloadDoc(\"$url\");return false;' target='_blank'>" . $dato["descripcion"] . '</a>';
				$completo[$j]["id_presentacion"] = $dato["id_presentacion"];
				$completo[$j]["fecha"]         = $dato["fecha"];
				$completo[$j]["dni"] = $dato["dni"];
				$completo[$j]["copydoc"] = $dato["copydoc"];
				$completo[$j]["depositario"] = $dato["depositario"];
				$completo[$j]["firma"] = $dato["firma"];
				$j++;
			}
			return $completo;
	}

	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
		echo "
		//---- Eventos ---------------------------------------------
		
				function downloadDoc(url){
					//alert(url+'&tcm=popup&tm=1');
					window.open(url+'&tcm=popup&tm=1');
				}
		";
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__cancelar()
	{
		$this->set_pantalla('pant_seleccion');
	}

	function evt__cuadro__copydoc($seleccion)
	{
		toba::db('ledig')->consultar("select sp_copydoc(" . $seleccion["id_presentacion"] . ")");
		$this->set_pantalla('pant_seleccion');
	}

}
?>
