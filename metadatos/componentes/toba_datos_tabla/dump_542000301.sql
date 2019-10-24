------------------------------------------------------------
--[542000301]--  leg_config 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 542
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'ledig', --proyecto
	'542000301', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_tabla', --clase
	'542000001', --punto_montaje
	NULL, --subclase
	NULL, --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'leg_config', --nombre
	NULL, --titulo
	NULL, --colapsable
	NULL, --descripcion
	'ledig', --fuente_datos_proyecto
	'ledig', --fuente_datos
	NULL, --solicitud_registrar
	NULL, --solicitud_obj_obs_tipo
	NULL, --solicitud_obj_observacion
	NULL, --parametro_a
	NULL, --parametro_b
	NULL, --parametro_c
	NULL, --parametro_d
	NULL, --parametro_e
	NULL, --parametro_f
	NULL, --usuario
	'2019-05-16 11:43:24', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 542

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'ledig', --objeto_proyecto
	'542000301', --objeto
	NULL, --max_registros
	NULL, --min_registros
	NULL, --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'leg_config', --tabla
	NULL, --tabla_ext
	NULL, --alias
	NULL, --modificar_claves
	'ledig', --fuente_datos_proyecto
	'ledig', --fuente_datos
	'1', --permite_actualizacion_automatica
	NULL, --esquema
	NULL  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 542
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000301', --objeto
	'542000724', --col_id
	'param', --columna
	'C', --tipo
	NULL, --pk
	NULL, --secuencia
	NULL, --largo
	NULL, --no_nulo
	NULL, --no_nulo_db
	NULL, --externa
	NULL  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000301', --objeto
	'542000725', --col_id
	'valor', --columna
	'C', --tipo
	NULL, --pk
	NULL, --secuencia
	NULL, --largo
	NULL, --no_nulo
	NULL, --no_nulo_db
	NULL, --externa
	NULL  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000301', --objeto
	'542000726', --col_id
	'id_config', --columna
	'E', --tipo
	'1', --pk
	'leg_config_id_config_seq', --secuencia
	NULL, --largo
	NULL, --no_nulo
	NULL, --no_nulo_db
	NULL, --externa
	NULL  --tabla
);
--- FIN Grupo de desarrollo 542
