CREATE TABLE siefu.dato_tramite (id INT AUTO_INCREMENT, boleta_prenumerada VARCHAR(30) UNIQUE, id_ente INT NOT NULL, id_oficina_seccional VARCHAR(45) NOT NULL, oficina_seccion VARCHAR(45) NOT NULL, fecha DATE NOT NULL, detalletramite_id BIGINT UNIQUE, INDEX id_ente_idx (id_ente), INDEX detalletramite_id_idx (detalletramite_id), PRIMARY KEY(id, boleta_prenumerada)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.detalle_tramite (id BIGINT AUTO_INCREMENT, boleta_prenumerada VARCHAR(30) UNIQUE, tramite_id INT UNIQUE, INDEX tramite_id_idx (tramite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.domicilio (boleta_prenumerada VARCHAR(30), id_provincia INT NOT NULL, partido_dtop VARCHAR(45), barrio VARCHAR(45), calle VARCHAR(45), nro_calle VARCHAR(45), piso VARCHAR(45), depto VARCHAR(45), cod_postal VARCHAR(45), tel_prefijo VARCHAR(45), tel_numero VARCHAR(45), localidad VARCHAR(100), INDEX id_provincia_idx (id_provincia), PRIMARY KEY(boleta_prenumerada)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.educacional (id INT AUTO_INCREMENT, dni_ente VARCHAR(45), lee_escribe VARCHAR(2) NOT NULL, mas_nivel_educional VARCHAR(45), titulo_alcanzado VARCHAR(45), titulo_posgrado VARCHAR(45), profecion VARCHAR(45), ocupacion VARCHAR(45), cambios VARCHAR(100), PRIMARY KEY(id, dni_ente)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.ente (id INT AUTO_INCREMENT, dni VARCHAR(45) NOT NULL, dni2 VARCHAR(45) NOT NULL, fecha_nacimiento DATE NOT NULL, apellido VARCHAR(45) NOT NULL, nombre VARCHAR(45) NOT NULL, provincia_nacimiento VARCHAR(45) NOT NULL, partido_ciudad_naci VARCHAR(45), id_localidad_naci INT NOT NULL, extranjero TINYINT NOT NULL, id_estado_civil INT NOT NULL, oficina_identificacion VARCHAR(30), veterano VARCHAR(2), provincia_id INT, partido_depto VARCHAR(45), localidad VARCHAR(100), barrio VARCHAR(45), calle VARCHAR(45), nro_calle VARCHAR(45), piso VARCHAR(45), depto VARCHAR(45), cod_postal VARCHAR(45), tel_prefijo VARCHAR(45), tel_numero VARCHAR(45), sexo_id INT NOT NULL, pais_id INT, INDEX dni_idx (dni), INDEX id_estado_civil_idx (id_estado_civil), INDEX provincia_id_idx (provincia_id), INDEX sexo_id_idx (sexo_id), INDEX pais_id_idx (pais_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.entidades (id INT AUTO_INCREMENT, codigo INT NOT NULL, descripcion VARCHAR(45), numero VARCHAR(20), PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.estado_civil (id INT AUTO_INCREMENT, descripcion VARCHAR(50), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE siefu.identificacion (boleta_prenumerada VARCHAR(30) UNIQUE, documento VARCHAR(45), nacionalidad VARCHAR(45), nacionalidad_acquirida VARCHAR(45), pasaporte VARCHAR(45), fecha_ingreso_pais DATE, cat_radicacion CHAR(1), fecha_radicacion DATE, expediente_nro VARCHAR(45), res_dis_dtop VARCHAR(45), fecha_vencimiento_temporaria DATE, prorroga DATE, apellido_nombre_padre VARCHAR(45), apellido_nombre_madre VARCHAR(45), detalletramite_id BIGINT UNIQUE, INDEX detalletramite_id_idx (detalletramite_id), PRIMARY KEY(boleta_prenumerada)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.localidad (id INT, descripcion VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.nacimiento (boleta_prenumerada VARCHAR(30) UNIQUE, incripto_en VARCHAR(150), nro_oficina VARCHAR(150), id_provincia VARCHAR(2) NOT NULL, acta_nro VARCHAR(45), tomo_nro VARCHAR(45), folio_nro VARCHAR(45), anio VARCHAR(45), observaciones VARCHAR(150), apellido_padre VARCHAR(45), nombre_padre VARCHAR(45), dni_padre VARCHAR(45), apellido_madre VARCHAR(45), nombre_madre VARCHAR(45), dni_madre VARCHAR(45), detalletramite_id BIGINT UNIQUE, INDEX detalletramite_id_idx (detalletramite_id), PRIMARY KEY(boleta_prenumerada)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.pais (id INT AUTO_INCREMENT, descripcion VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.provincia (id INT, descripcion VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.rectificacion (boleta_prenumerada VARCHAR(30) UNIQUE, dice VARCHAR(150), debe_decir VARCHAR(150), cartilla VARCHAR(2), detalletramite_id BIGINT UNIQUE, INDEX detalletramite_id_idx (detalletramite_id), PRIMARY KEY(boleta_prenumerada)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.reposicion (boleta_prenumerada VARCHAR(30) UNIQUE, dice VARCHAR(150), debe_decir VARCHAR(150), cartilla VARCHAR(2), detalletramite_id BIGINT UNIQUE, INDEX detalletramite_id_idx (detalletramite_id), PRIMARY KEY(boleta_prenumerada)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE sexo (id INT AUTO_INCREMENT, descripcion VARCHAR(8), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE siefu.tramite (id INT AUTO_INCREMENT, descripcion VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
CREATE TABLE siefu.usuario (id INT AUTO_INCREMENT, usuario VARCHAR(30), pass VARCHAR(30) NOT NULL, nombre VARCHAR(50) NOT NULL, apellido VARCHAR(50) NOT NULL, num_entidad INT NOT NULL, admin INT NOT NULL, entidades_id INT NOT NULL, INDEX entidades_id_idx (entidades_id), PRIMARY KEY(id, usuario)) DEFAULT CHARACTER SET latin1 ENGINE = InnoDB;
ALTER TABLE siefu.dato_tramite ADD CONSTRAINT siefu_dato_tramite_id_ente_siefu_ente_id FOREIGN KEY (id_ente) REFERENCES siefu.ente(id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE siefu.dato_tramite ADD CONSTRAINT siefu_dato_tramite_detalletramite_id_siefu_detalle_tramite_id FOREIGN KEY (detalletramite_id) REFERENCES siefu.detalle_tramite(id);
ALTER TABLE siefu.detalle_tramite ADD CONSTRAINT siefu_detalle_tramite_tramite_id_siefu_tramite_id FOREIGN KEY (tramite_id) REFERENCES siefu.tramite(id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE siefu.domicilio ADD CONSTRAINT siefu_domicilio_id_provincia_siefu_provincia_id FOREIGN KEY (id_provincia) REFERENCES siefu.provincia(id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE siefu.educacional ADD CONSTRAINT siefu_educacional_dni_ente_siefu_ente_dni FOREIGN KEY (dni_ente) REFERENCES siefu.ente(dni) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE siefu.ente ADD CONSTRAINT siefu_ente_sexo_id_sexo_id FOREIGN KEY (sexo_id) REFERENCES sexo(id);
ALTER TABLE siefu.ente ADD CONSTRAINT siefu_ente_provincia_id_siefu_provincia_id FOREIGN KEY (provincia_id) REFERENCES siefu.provincia(id);
ALTER TABLE siefu.ente ADD CONSTRAINT siefu_ente_pais_id_siefu_pais_id FOREIGN KEY (pais_id) REFERENCES siefu.pais(id);
ALTER TABLE siefu.ente ADD CONSTRAINT siefu_ente_id_estado_civil_siefu_estado_civil_id FOREIGN KEY (id_estado_civil) REFERENCES siefu.estado_civil(id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE siefu.identificacion ADD CONSTRAINT siefu_identificacion_detalletramite_id_siefu_detalle_tramite_id FOREIGN KEY (detalletramite_id) REFERENCES siefu.detalle_tramite(id);
ALTER TABLE siefu.nacimiento ADD CONSTRAINT siefu_nacimiento_detalletramite_id_siefu_detalle_tramite_id FOREIGN KEY (detalletramite_id) REFERENCES siefu.detalle_tramite(id);
ALTER TABLE siefu.rectificacion ADD CONSTRAINT siefu_rectificacion_detalletramite_id_siefu_detalle_tramite_id FOREIGN KEY (detalletramite_id) REFERENCES siefu.detalle_tramite(id);
ALTER TABLE siefu.reposicion ADD CONSTRAINT siefu_reposicion_detalletramite_id_siefu_detalle_tramite_id FOREIGN KEY (detalletramite_id) REFERENCES siefu.detalle_tramite(id);
ALTER TABLE siefu.usuario ADD CONSTRAINT siefu_usuario_entidades_id_siefu_entidades_id FOREIGN KEY (entidades_id) REFERENCES siefu.entidades(id);
