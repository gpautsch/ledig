CREATE OR REPLACE FUNCTION public.sp_get_server()
  RETURNS character varying AS
$BODY$
DECLARE
	servidor varchar;
BEGIN
	 servidor := (select valor from leg_config where param like '%Server%');
	 return servidor;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.sp_get_server()
  OWNER TO postgres;



ALTER TABLE ledig ADD COLUMN cohorte character varying(4);

CREATE TABLE leg_depositarios
(
  id_dep serial NOT NULL,
  depositario character varying,
  CONSTRAINT pk_depositarios PRIMARY KEY (id_dep)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE leg_depositarios
  OWNER TO gpautsch;


ALTER TABLE leg_presentaciones
  ADD COLUMN depositario integer;
ALTER TABLE leg_presentaciones
  ADD CONSTRAINT fk_depositario FOREIGN KEY (id_dep)
      REFERENCES leg_depositarios (id_dep) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE leg_presentaciones
  ADD COLUMN id_tipo_doc integer;
ALTER TABLE leg_presentaciones
   ALTER COLUMN id_tipo_doc SET DEFAULT 1;
ALTER TABLE leg_presentaciones
  ADD CONSTRAINT fk_tipo_doc FOREIGN KEY (id_tipo_doc) REFERENCES leg_tipo_doc (tipo_doc) ON UPDATE NO ACTION ON DELETE NO ACTION;




ALTER TABLE leg_cont_presentacion
  DROP CONSTRAINT pk_id_cont_presentacion;
ALTER TABLE leg_cont_presentacion
  DROP CONSTRAINT fk_id_presentacion;




