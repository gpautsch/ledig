------------------------------------------------------------
--[542000248]--  DT - ledig 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 542
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'ledig', --proyecto
	'542000248', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_tabla', --clase
	'542000001', --punto_montaje
	'dt_ledig', --subclase
	'datos/dt_ledig.php', --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'DT - ledig', --nombre
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
	'2017-02-13 15:37:38', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 542

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'542000001', --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'ledig', --tabla
	NULL, --tabla_ext
	NULL, --alias
	'0', --modificar_claves
	'ledig', --fuente_datos_proyecto
	'ledig', --fuente_datos
	'1', --permite_actualizacion_automatica
	'public', --esquema
	'public'  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 542
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000472', --col_id
	'dni', --columna
	'C', --tipo
	'1', --pk
	'', --secuencia
	'15', --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000473', --col_id
	'legajo', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'12', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000474', --col_id
	'unidad_academica', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'5', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000475', --col_id
	'sede', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'9', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000476', --col_id
	'carrera', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'7', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000477', --col_id
	'estado', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000478', --col_id
	'apellido', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'30', --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000479', --col_id
	'nombres', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'30', --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000706', --col_id
	'foto', --columna
	'B', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000707', --col_id
	'upfoto', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'ledig', --objeto_proyecto
	'542000248', --objeto
	'542000711', --col_id
	'cohorte', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'4', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ledig'  --tabla
);
--- FIN Grupo de desarrollo 542
