<?php
/**
 * Esta clase fue y será generada automáticamente. NO EDITAR A MANO.
 * @ignore
 */
class ledig_autoload 
{
	static function existe_clase($nombre)
	{
		return isset(self::$clases[$nombre]);
	}

	static function cargar($nombre)
	{
		if (self::existe_clase($nombre)) { 
			 require_once(dirname(__FILE__) .'/'. self::$clases[$nombre]); 
		}
	}

	static protected $clases = array(
		'ledig_ci' => 'extension_toba/componentes/ledig_ci.php',
		'ledig_cn' => 'extension_toba/componentes/ledig_cn.php',
		'ledig_datos_relacion' => 'extension_toba/componentes/ledig_datos_relacion.php',
		'ledig_datos_tabla' => 'extension_toba/componentes/ledig_datos_tabla.php',
		'ledig_ei_arbol' => 'extension_toba/componentes/ledig_ei_arbol.php',
		'ledig_ei_archivos' => 'extension_toba/componentes/ledig_ei_archivos.php',
		'ledig_ei_calendario' => 'extension_toba/componentes/ledig_ei_calendario.php',
		'ledig_ei_codigo' => 'extension_toba/componentes/ledig_ei_codigo.php',
		'ledig_ei_cuadro' => 'extension_toba/componentes/ledig_ei_cuadro.php',
		'ledig_ei_esquema' => 'extension_toba/componentes/ledig_ei_esquema.php',
		'ledig_ei_filtro' => 'extension_toba/componentes/ledig_ei_filtro.php',
		'ledig_ei_firma' => 'extension_toba/componentes/ledig_ei_firma.php',
		'ledig_ei_formulario' => 'extension_toba/componentes/ledig_ei_formulario.php',
		'ledig_ei_formulario_ml' => 'extension_toba/componentes/ledig_ei_formulario_ml.php',
		'ledig_ei_grafico' => 'extension_toba/componentes/ledig_ei_grafico.php',
		'ledig_ei_mapa' => 'extension_toba/componentes/ledig_ei_mapa.php',
		'ledig_servicio_web' => 'extension_toba/componentes/ledig_servicio_web.php',
		'ledig_comando' => 'extension_toba/ledig_comando.php',
		'ledig_modelo' => 'extension_toba/ledig_modelo.php',
	);
}
?>