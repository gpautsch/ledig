<?php
class dao_ledig
{

	function get_carreras()
	{
		$sql = "SELECT carrera, nombre FROM sga_carreras";
		return toba::db('ledig')->consultar($sql);
	}

	function get_depositarios()
	{
		$sql = "SELECT id_dep, depositario FROM leg_depositarios";
		return toba::db('ledig')->consultar($sql);
	}


	function get_cohorte()
	{
		$sql = "select valor from leg_config where param like 'anio%' order by 1 DESC";
		return toba::db('ledig')->consultar($sql);
	}

	function get_legajos()
	{
		$sql = "SELECT 
			  ledig.dni, 
			  ledig.apellido || ', ' ||
			  ledig.nombres as nombre
			FROM 
			  public.ledig;
			ORDER BY 2";
		return toba::db('ledig')->consultar($sql);
	}

	function get_legajo_dni($dni)
	{
		$sql = "SELECT * FROM ledig WHERE dni = '" . $dni . "'";
		return toba::db('ledig')->consultar($sql);
	}

	function import_legajo($idpre)
	{
		include ('datos/dao_preinsc.php');
		// consigo registro de pre inscripcion
		$regpre = dao_preinsc::get_regpre($idpre);
		// consulto bd ledig si ya se importo ese legajo
		$regledig = dao_ledig::get_legajo_dni($regpre[0]['nro_documento']);

		if (isset($regledig[0]['dni'])) {
			return false;
		} else{
			$periodo_pre = dao_preinsc::get_periodo_insc($regpre[0]['carrera']);
			$sql = " insert into ledig (dni,unidad_academica,sede,carrera,cohorte,estado,apellido,nombres) 
				values ('".$regpre[0]['nro_documento'] . "','" .
					$regpre[0]['unidad_academica'] . "','" .
					$regpre[0]['sede'] . "'," .
					$regpre[0]['carrera'] . ",'" .
					$periodo_pre[0]['periodo'] . "','" .
					$regpre[0]['estado'] . "','" .
					$regpre[0]['apellido'] . "','" .
					$regpre[0]['nombres'] . "')" ;
			toba::db('ledig')->consultar($sql);
			return true;
		}		
	}

}
?>
