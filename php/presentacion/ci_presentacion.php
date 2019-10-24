<?php
include ('datos/dao_ledig.php');
class ci_presentacion extends toba_ci
{
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
			//$cuadro->set_datos($this->dep('datos')->tabla('leg_presentaciones')->get_listado($this->s__datos_filtro));
			$datos=$this->dep('datos')->tabla('leg_presentaciones')->get_listado($this->s__datos_filtro);
			//echo ei_arbol($cuadro);
			if (!empty($datos)) {
				$cuadro->set_datos($this->creaLink($datos));
			}
		} else {
			//$cuadro->set_datos($this->dep('datos')->tabla('leg_presentaciones')->get_listado());
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
		//echo ei_arbol($this->s__datos_filtro);
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
		//$server = toba::db('cfg_usuarios')->consultar("select sp_get_server()");
		//echo ei_arbol($cohorte[0]['cohorte']);

		if (is_array($datos['url_pdf'])) {

		//$dni = toba::db('ledig')->consultar("select sp_dni_preinsc(" . $datos['dni'] . ")");
		$stamp = toba::db('ledig')->consultar("SELECT nextval('leg_presentaciones_id_presentacion_seq') as now");
		// Armo url + el sud dir cohorte y dni
		$url ='legajos/' .  $cohorte[0]['cohorte'] . '/' . $datos['dni'] . '/'; 
		//echo ei_arbol($url);
		//$datos['url_pdf']['name'] = $stamp[0]['now'] . "_" . $datos['url_pdf']['name'];
		$datos['url_pdf']['name'] = $stamp[0]['now'] . "_" . $datos['url_pdf']['name'];
		if (file_exists($url)) {  // Compruebo si existe el directorio en el Server
			if (file_exists($url.$datos['url_pdf']['name'])) {  // Compruebo si existe el archivo
				// Renombrar archivo existente para que pueda subir el nuevo
				rename($url . $datos['url_pdf']['name'],$url . "_" . $datos['url_pdf']['name']);
			} 
		} else {
			// el directorio no existe, debo crearlo
			mkdir($url);
		}
		//////  Antes debo preguntar si esta puesto el tilde en el upload
			if (copy($datos['url_pdf']['tmp_name'] , $url . $datos['url_pdf']['name'])){
				$datos["url_pdf"] = $url.$datos['url_pdf']['name'];
				}
			} else {
		unset($datos["url_pdf"]); // PORQUE SINO ME GRABA NULL CUANDO NO MODIFICO EF_UPLOAD
			}
	//echo ei_arbol($datos);
	$this->dep('datos')->tabla('leg_presentaciones')->set($datos);

	}

	function resetear()
	{
		$this->dep('datos')->resetear();
		$this->set_pantalla('pant_seleccion');
	}

	//---- EVENTOS CI -------------------------------------------------------------------

	function evt__agregar()
	{
/*        if (isset($this->s__datos_filtro)) {
			$this->dep('datos')->cargar($this->s__datos_filtro);
		}
*/        $this->set_pantalla('pant_edicion');
	}

	function evt__volver()
	{
		//$this->resetear();

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
		$dato = toba::memoria()->get_dato_sincronizado($id_pre);
		//echo ei_arbol($dato);
//        echo "****************  ". $thisdato['id_preinscripcion'] ."  ****<br>";
		if (array_no_nulo($dato)) {
			$this->s__datos_filtro = $dato;
		}
	}
	function creaLink($datos) {
			$j=0;
			//$server = toba::db('ledig')->consultar("select sp_get_server()");
			foreach($datos as $dato)        
			{

				//http://ledig.fce.unam.edu.ar/legajos/2017/25450352/2017-12-01%2010:25:02.122891+00_LEDIG%20MArce%20Pareyra.pdf

				// RUTA A FILE SIN DOMINIO
				//$path_comprobante_corto = $path_corto.'/'.$nombre_comprobante;

				//$path_comprobante_corto = "legajos/2017/25450352/2017-12-01%2010:25:02.122891+00_LEDIG%20MArce%20Pareyra.pdf";
				$path_comprobante_corto = $dato["url_pdf"];

				// TOMA EL file.pdf
				$param = array('file'=> $path_comprobante_corto);
				$url = toba::vinculador()->get_url('ledig', '542000059',$param);
				// NOMBRE PARA MOSTRAR EN EL LINK
				$nombre_comprobante = 'Comprobante:'.$dato["descripcion"];
				$img = toba_recurso::imagen_proyecto('logo.gif',true,null,null,"Ver documento");
				
                $completo[$j]["url_pdf"]  = "<a href=# onclick='downloadDoc(\"$url\");return false;' target='_blank'>" . $dato["descripcion"] . '</a>';


				$completo[$j]["id_presentacion"] = $dato["id_presentacion"];                
				$completo[$j]["fecha"]         = $dato["fecha"];
				$completo[$j]["dni"] = $dato["dni"];
				$completo[$j]["copydoc"] = $dato["copydoc"];
				$completo[$j]["depositario"] = $dato["depositario"];
				//$url=$server[0]["sp_get_server"]. '/'.$dato["url_pdf"];
				//$completo[$j]["url_pdf"] = '<a href="' . $url . '" target="_blank">' .$dato["descripcion"] . '</a>';
//                $completo[$j]["url_pdf"] = '<a href="' . $url . '" target="_blank">' .$dato["url_pdf"] . '</a>';

				$completo[$j]["firma"]         = $dato["firma"];
				$j++;
			}
			return $completo;
	}

	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__cuadro__cont_presentacion($seleccion)
	{
		//echo ei_arbol($seleccion);
		toba::memoria()->set_dato_sincronizado($dni,$seleccion);
		toba::vinculador()->navegar_a(toba::proyecto()->get_id(),'542000057');
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