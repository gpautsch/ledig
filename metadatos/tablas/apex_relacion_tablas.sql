
------------------------------------------------------------
-- apex_relacion_tablas
------------------------------------------------------------

--- INICIO Grupo de desarrollo 542
INSERT INTO apex_relacion_tablas (fuente_datos_proyecto, fuente_datos, proyecto, relacion_tablas, tabla_1, tabla_1_cols, tabla_2, tabla_2_cols) VALUES (
	'ledig', --fuente_datos_proyecto
	'ledig', --fuente_datos
	'ledig', --proyecto
	'542000001', --relacion_tablas
	'ledig', --tabla_1
	'carrera,unidad_academica', --tabla_1_cols
	'sga_carreras', --tabla_2
	'carrera,unidad_academica'  --tabla_2_cols
);
INSERT INTO apex_relacion_tablas (fuente_datos_proyecto, fuente_datos, proyecto, relacion_tablas, tabla_1, tabla_1_cols, tabla_2, tabla_2_cols) VALUES (
	'ledig', --fuente_datos_proyecto
	'ledig', --fuente_datos
	'ledig', --proyecto
	'542000002', --relacion_tablas
	'ledig', --tabla_1
	'dni', --tabla_1_cols
	'leg_presentaciones', --tabla_2
	'dni'  --tabla_2_cols
);
INSERT INTO apex_relacion_tablas (fuente_datos_proyecto, fuente_datos, proyecto, relacion_tablas, tabla_1, tabla_1_cols, tabla_2, tabla_2_cols) VALUES (
	'ledig', --fuente_datos_proyecto
	'ledig', --fuente_datos
	'ledig', --proyecto
	'542000003', --relacion_tablas
	'leg_presentaciones', --tabla_1
	'id_presentacion', --tabla_1_cols
	'leg_cont_presentacion', --tabla_2
	'id_presentacion'  --tabla_2_cols
);
--- FIN Grupo de desarrollo 542
