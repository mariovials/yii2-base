--
-- PostgreSQL database dump
--
DROP SCHEMA public CASCADE;
CREATE SCHEMA public;

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.publicacion DROP CONSTRAINT "fk-publicacion-archivo_id-archivo-id";
DROP INDEX public."configuracion-codigo-tipo_php-index";
ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_correo_electronico_key;
ALTER TABLE ONLY public.publicacion DROP CONSTRAINT publicacion_pkey;
ALTER TABLE ONLY public.migration DROP CONSTRAINT migration_pkey;
ALTER TABLE ONLY public.configuracion DROP CONSTRAINT configuracion_pkey;
ALTER TABLE ONLY public.archivo DROP CONSTRAINT archivo_pkey;
ALTER TABLE public.usuario ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.publicacion ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.configuracion ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.archivo ALTER COLUMN id DROP DEFAULT;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--



ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: archivo; Type: TABLE; Schema: public; Owner: arpu; Tablespace:
--

CREATE TABLE archivo (
    id integer NOT NULL,
    tipo smallint,
    nombre character varying(255),
    mime_type character varying(128),
    extension character varying(5),
    size integer,
    basename character varying(255),
    filename character varying(255),
    ruta character varying(255),
    ruta_web character varying(255),
    ruta_min character varying(255),
    fecha_creacion timestamp(0) without time zone DEFAULT now() NOT NULL,
    fecha_edicion timestamp(0) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.archivo OWNER TO arpu;

--
-- Name: archivo_id_seq; Type: SEQUENCE; Schema: public; Owner: arpu
--

CREATE SEQUENCE archivo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.archivo_id_seq OWNER TO arpu;

--
-- Name: archivo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arpu
--

ALTER SEQUENCE archivo_id_seq OWNED BY archivo.id;


--
-- Name: configuracion; Type: TABLE; Schema: public; Owner: arpu; Tablespace:
--

CREATE TABLE configuracion (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL,
    codigo character varying(32) NOT NULL,
    tipo_php character varying(255) NOT NULL,
    valor character varying(255),
    descripcion text,
    tipo character varying(255)
);


ALTER TABLE public.configuracion OWNER TO arpu;

--
-- Name: configuracion_id_seq; Type: SEQUENCE; Schema: public; Owner: arpu
--

CREATE SEQUENCE configuracion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.configuracion_id_seq OWNER TO arpu;

--
-- Name: configuracion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arpu
--

ALTER SEQUENCE configuracion_id_seq OWNED BY configuracion.id;


--
-- Name: migration; Type: TABLE; Schema: public; Owner: arpu; Tablespace:
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE public.migration OWNER TO arpu;

--
-- Name: publicacion; Type: TABLE; Schema: public; Owner: arpu; Tablespace:
--

CREATE TABLE publicacion (
    id integer NOT NULL,
    tipo integer DEFAULT 1 NOT NULL,
    nombre character varying(255),
    autor character varying(255),
    editores character varying(255),
    editorial character varying(255),
    isbn character varying(64),
    idioma character varying(255),
    link character varying(256),
    descripcion text,
    periodo integer,
    mes integer,
    dia integer,
    orden integer,
    disponible boolean,
    archivo_id integer,
    visible boolean,
    fecha_creacion timestamp(0) without time zone,
    fecha_edicion timestamp(0) without time zone,
    creado_por integer,
    editado_por integer
);


ALTER TABLE public.publicacion OWNER TO arpu;

--
-- Name: publicacion_id_seq; Type: SEQUENCE; Schema: public; Owner: arpu
--

CREATE SEQUENCE publicacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.publicacion_id_seq OWNER TO arpu;

--
-- Name: publicacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arpu
--

ALTER SEQUENCE publicacion_id_seq OWNED BY publicacion.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: arpu; Tablespace:
--

CREATE TABLE usuario (
    id integer NOT NULL,
    estado smallint DEFAULT 1 NOT NULL,
    nombre character varying(32) NOT NULL,
    apellido character varying(32),
    contrasena character varying(255) NOT NULL,
    correo_electronico character varying(254) NOT NULL,
    auth_key character varying(32) NOT NULL,
    fecha_creacion timestamp(0) without time zone NOT NULL,
    fecha_edicion timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.usuario OWNER TO arpu;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: arpu
--

CREATE SEQUENCE usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO arpu;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arpu
--

ALTER SEQUENCE usuario_id_seq OWNED BY usuario.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: arpu
--

ALTER TABLE ONLY archivo ALTER COLUMN id SET DEFAULT nextval('archivo_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: arpu
--

ALTER TABLE ONLY configuracion ALTER COLUMN id SET DEFAULT nextval('configuracion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: arpu
--

ALTER TABLE ONLY publicacion ALTER COLUMN id SET DEFAULT nextval('publicacion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: arpu
--

ALTER TABLE ONLY usuario ALTER COLUMN id SET DEFAULT nextval('usuario_id_seq'::regclass);


--
-- Data for Name: archivo; Type: TABLE DATA; Schema: public; Owner: arpu
--

INSERT INTO archivo VALUES (1, NULL, 'telemedicina.jpg', 'image/jpeg', 'jpg', 311540, 'telemedicina', 'telemedicina.jpg', '/archivos/1_telemedicina.jpg', '/archivos/1_telemedicina_web.jpg', '/archivos/1_telemedicina_min.jpg', '2024-01-22 11:22:43', '2024-01-22 11:22:43');
INSERT INTO archivo VALUES (2, NULL, 'molecvetlogooficiallogotipo.jpg', 'image/jpeg', 'jpg', 8959, 'molecvetlogooficiallogotipo', 'molecvetlogooficiallogotipo.jpg', '/archivos/2_molecvetlogooficiallogotipo.jpg', '/archivos/2_molecvetlogooficiallogotipo_web.jpg', '/archivos/2_molecvetlogooficiallogotipo_min.jpg', '2024-01-22 11:23:26', '2024-01-22 11:23:26');
INSERT INTO archivo VALUES (19, NULL, '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', 'image/png', 'png', 183795, '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)', '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', '/archivos/19_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', '/archivos/19_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)_web.png', '/archivos/19_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)_min.png', '2024-01-22 13:17:46', '2024-01-22 13:17:46');
INSERT INTO archivo VALUES (3, NULL, 'telemedicina.jpg', 'image/jpeg', 'jpg', 311540, 'telemedicina', 'telemedicina.jpg', '/archivos/3_telemedicina.jpg', '/archivos/3_telemedicina_web.jpg', '/archivos/3_telemedicina_min.jpg', '2024-01-22 11:24:14', '2024-01-22 11:24:14');
INSERT INTO archivo VALUES (4, NULL, 'mapa.png', '', 'png', 0, 'mapa', 'mapa.png', NULL, NULL, NULL, '2024-01-22 11:25:02', '2024-01-22 11:25:02');
INSERT INTO archivo VALUES (5, NULL, 'mapa.png', '', 'png', 0, 'mapa', 'mapa.png', NULL, NULL, NULL, '2024-01-22 11:26:00', '2024-01-22 11:26:00');
INSERT INTO archivo VALUES (6, NULL, 'mapa.png', '', 'png', 0, 'mapa', 'mapa.png', NULL, NULL, NULL, '2024-01-22 11:26:23', '2024-01-22 11:26:23');
INSERT INTO archivo VALUES (20, NULL, '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', 'image/png', 'png', 183795, '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)', '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', '/archivos/20_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', '/archivos/20_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)_web.png', '/archivos/20_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)_min.png', '2024-01-22 13:17:57', '2024-01-22 13:17:57');
INSERT INTO archivo VALUES (21, NULL, 'Jorge_lobos.jpg', 'image/jpeg', 'jpg', 135582, 'Jorge_lobos', 'Jorge_lobos.jpg', '/archivos/21_Jorge_lobos.jpg', '/archivos/21_Jorge_lobos_web.jpg', '/archivos/21_Jorge_lobos_min.jpg', '2024-01-22 13:18:08', '2024-01-22 13:18:08');
INSERT INTO archivo VALUES (15, NULL, 'telemedicina.jpg', 'image/jpeg', 'jpg', 311540, 'telemedicina', 'telemedicina.jpg', NULL, NULL, NULL, '2024-01-22 11:52:10', '2024-01-22 11:52:10');
INSERT INTO archivo VALUES (18, NULL, 'Jorge_lobos.jpg', 'image/jpeg', 'jpg', 135582, 'Jorge_lobos', 'Jorge_lobos.jpg', '/archivos/18_Jorge_lobos.jpg', '/archivos/18_Jorge_lobos_web.jpg', '/archivos/18_Jorge_lobos_min.jpg', '2024-01-22 13:08:52', '2024-01-22 13:08:52');
INSERT INTO archivo VALUES (36, NULL, 'Situaciones.png', 'image/png', 'png', 678430, 'Situaciones', 'Situaciones.png', '/archivos/36_Situaciones.png', '/archivos/36_Situaciones_web.png', '/archivos/36_Situaciones_min.png', '2024-01-28 11:23:45', '2024-01-28 11:23:45');
INSERT INTO archivo VALUES (25, NULL, '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', 'image/png', 'png', 183795, '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)', '21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', '/archivos/25_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado).png', '/archivos/25_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)_web.png', '/archivos/25_21_Alejandro Presente - memoria desde la arquitectura - version web v02 (arrastrado)_min.png', '2024-01-26 18:32:06', '2024-01-26 18:32:06');
INSERT INTO archivo VALUES (31, NULL, '09_ROBERTO_GOYCOOLE.jpg', 'image/jpeg', 'jpg', 189098, '09_ROBERTO_GOYCOOLE', '09_ROBERTO_GOYCOOLE.jpg', '/archivos/31_09_ROBERTO_GOYCOOLE.jpg', '/archivos/31_09_ROBERTO_GOYCOOLE_web.jpg', '/archivos/31_09_ROBERTO_GOYCOOLE_min.jpg', '2024-01-28 11:01:26', '2024-01-28 11:01:26');
INSERT INTO archivo VALUES (26, NULL, 'Portada.jpg', 'image/jpeg', 'jpg', 118570, 'Portada', 'Portada.jpg', '/archivos/26_Portada.jpg', '/archivos/26_Portada_web.jpg', '/archivos/26_Portada_min.jpg', '2024-01-28 10:49:42', '2024-01-28 10:49:42');
INSERT INTO archivo VALUES (27, NULL, '5m2.jpg', 'image/jpeg', 'jpg', 73133, '5m2', '5m2.jpg', '/archivos/27_5m2.jpg', '/archivos/27_5m2_web.jpg', '/archivos/27_5m2_min.jpg', '2024-01-28 10:53:33', '2024-01-28 10:53:33');
INSERT INTO archivo VALUES (28, NULL, '06_TRIBUNALES.jpg', 'image/jpeg', 'jpg', 1341702, '06_TRIBUNALES', '06_TRIBUNALES.jpg', '/archivos/28_06_TRIBUNALES.jpg', '/archivos/28_06_TRIBUNALES_web.jpg', '/archivos/28_06_TRIBUNALES_min.jpg', '2024-01-28 10:55:15', '2024-01-28 10:55:15');
INSERT INTO archivo VALUES (32, NULL, '10_CREADORAS.jpg', 'image/jpeg', 'jpg', 1216070, '10_CREADORAS', '10_CREADORAS.jpg', '/archivos/32_10_CREADORAS.jpg', '/archivos/32_10_CREADORAS_web.jpg', '/archivos/32_10_CREADORAS_min.jpg', '2024-01-28 11:04:49', '2024-01-28 11:04:49');
INSERT INTO archivo VALUES (29, NULL, '05_Atlas.png', 'image/png', 'png', 183808, '05_Atlas', '05_Atlas.png', '/archivos/29_05_Atlas.png', '/archivos/29_05_Atlas_web.png', '/archivos/29_05_Atlas_min.png', '2024-01-28 10:56:49', '2024-01-28 10:56:49');
INSERT INTO archivo VALUES (30, NULL, '08_OSVALDO_CACERES.jpg', 'image/jpeg', 'jpg', 195023, '08_OSVALDO_CACERES', '08_OSVALDO_CACERES.jpg', '/archivos/30_08_OSVALDO_CACERES.jpg', '/archivos/30_08_OSVALDO_CACERES_web.jpg', '/archivos/30_08_OSVALDO_CACERES_min.jpg', '2024-01-28 10:58:05', '2024-01-28 10:58:05');
INSERT INTO archivo VALUES (39, NULL, 'ISLA_04.jpg', 'image/jpeg', 'jpg', 161729, 'ISLA_04', 'ISLA_04.jpg', '/archivos/39_ISLA_04.jpg', '/archivos/39_ISLA_04_web.jpg', '/archivos/39_ISLA_04_min.jpg', '2024-01-28 11:45:30', '2024-01-28 11:45:30');
INSERT INTO archivo VALUES (33, NULL, '11_ISLA.jpg', 'image/jpeg', 'jpg', 1239649, '11_ISLA', '11_ISLA.jpg', '/archivos/33_11_ISLA.jpg', '/archivos/33_11_ISLA_web.jpg', '/archivos/33_11_ISLA_min.jpg', '2024-01-28 11:10:10', '2024-01-28 11:10:10');
INSERT INTO archivo VALUES (37, NULL, '6_diagonalbiobio.jpg', 'image/jpeg', 'jpg', 214133, '6_diagonalbiobio', '6_diagonalbiobio.jpg', '/archivos/37_6_diagonalbiobio.jpg', '/archivos/37_6_diagonalbiobio_web.jpg', '/archivos/37_6_diagonalbiobio_min.jpg', '2024-01-28 11:28:39', '2024-01-28 11:28:39');
INSERT INTO archivo VALUES (34, NULL, '02_Isla_02.png', 'image/png', 'png', 720224, '02_Isla_02', '02_Isla_02.png', '/archivos/34_02_Isla_02.png', '/archivos/34_02_Isla_02_web.png', '/archivos/34_02_Isla_02_min.png', '2024-01-28 11:16:28', '2024-01-28 11:16:28');
INSERT INTO archivo VALUES (40, NULL, 'ISLA 05.jpg', 'image/jpeg', 'jpg', 1909251, 'ISLA 05', 'ISLA 05.jpg', '/archivos/40_ISLA 05.jpg', '/archivos/40_ISLA 05_web.jpg', '/archivos/40_ISLA 05_min.jpg', '2024-01-28 11:48:16', '2024-01-28 11:48:16');
INSERT INTO archivo VALUES (38, NULL, '13_ISLA 03.jpg', 'image/jpeg', 'jpg', 516315, '13_ISLA 03', '13_ISLA 03.jpg', '/archivos/38_13_ISLA 03.jpg', '/archivos/38_13_ISLA 03_web.jpg', '/archivos/38_13_ISLA 03_min.jpg', '2024-01-28 11:28:59', '2024-01-28 11:28:59');
INSERT INTO archivo VALUES (42, NULL, '20_CONCEPCION_1930.jpg', 'image/jpeg', 'jpg', 377798, '20_CONCEPCION_1930', '20_CONCEPCION_1930.jpg', '/archivos/42_20_CONCEPCION_1930.jpg', '/archivos/42_20_CONCEPCION_1930_web.jpg', '/archivos/42_20_CONCEPCION_1930_min.jpg', '2024-01-28 11:52:33', '2024-01-28 11:52:33');
INSERT INTO archivo VALUES (41, NULL, 'PORTADA - MACO.jpg', 'image/jpeg', 'jpg', 1314305, 'PORTADA - MACO', 'PORTADA - MACO.jpg', '/archivos/41_PORTADA - MACO.jpg', '/archivos/41_PORTADA - MACO_web.jpg', '/archivos/41_PORTADA - MACO_min.jpg', '2024-01-28 11:49:38', '2024-01-28 11:49:38');
INSERT INTO archivo VALUES (43, NULL, '21_CHILLAN_MODERNO.jpg', 'image/jpeg', 'jpg', 3092347, '21_CHILLAN_MODERNO', '21_CHILLAN_MODERNO.jpg', '/archivos/43_21_CHILLAN_MODERNO.jpg', '/archivos/43_21_CHILLAN_MODERNO_web.jpg', '/archivos/43_21_CHILLAN_MODERNO_min.jpg', '2024-01-28 11:56:21', '2024-01-28 11:56:21');
INSERT INTO archivo VALUES (44, NULL, '22_XFORMAS.jpg', 'image/jpeg', 'jpg', 960171, '22_XFORMAS', '22_XFORMAS.jpg', '/archivos/44_22_XFORMAS.jpg', '/archivos/44_22_XFORMAS_web.jpg', '/archivos/44_22_XFORMAS_min.jpg', '2024-01-28 11:58:17', '2024-01-28 11:58:17');
INSERT INTO archivo VALUES (45, NULL, '23_ENCARGOS_COMUNES.jpg', 'image/jpeg', 'jpg', 302682, '23_ENCARGOS_COMUNES', '23_ENCARGOS_COMUNES.jpg', '/archivos/45_23_ENCARGOS_COMUNES.jpg', '/archivos/45_23_ENCARGOS_COMUNES_web.jpg', '/archivos/45_23_ENCARGOS_COMUNES_min.jpg', '2024-01-28 12:00:45', '2024-01-28 12:00:45');
INSERT INTO archivo VALUES (46, NULL, '24_LA ARQUITECTA DEL DESIERTO.jpg', 'image/jpeg', 'jpg', 1061144, '24_LA ARQUITECTA DEL DESIERTO', '24_LA ARQUITECTA DEL DESIERTO.jpg', '/archivos/46_24_LA ARQUITECTA DEL DESIERTO.jpg', '/archivos/46_24_LA ARQUITECTA DEL DESIERTO_web.jpg', '/archivos/46_24_LA ARQUITECTA DEL DESIERTO_min.jpg', '2024-01-28 12:02:43', '2024-01-28 12:02:43');
INSERT INTO archivo VALUES (47, NULL, '25_HUMEDALES_URBANOS.jpg', 'image/jpeg', 'jpg', 388437, '25_HUMEDALES_URBANOS', '25_HUMEDALES_URBANOS.jpg', '/archivos/47_25_HUMEDALES_URBANOS.jpg', '/archivos/47_25_HUMEDALES_URBANOS_web.jpg', '/archivos/47_25_HUMEDALES_URBANOS_min.jpg', '2024-01-28 12:26:29', '2024-01-28 12:26:29');
INSERT INTO archivo VALUES (48, NULL, '26_ENJUNDIA.jpg', 'image/jpeg', 'jpg', 709226, '26_ENJUNDIA', '26_ENJUNDIA.jpg', '/archivos/48_26_ENJUNDIA.jpg', '/archivos/48_26_ENJUNDIA_web.jpg', '/archivos/48_26_ENJUNDIA_min.jpg', '2024-01-28 12:27:33', '2024-01-28 12:27:33');
INSERT INTO archivo VALUES (49, NULL, '27_OSVALDO CÁCERES GONZÁLEZ.jpg', 'image/jpeg', 'jpg', 1198635, '27_OSVALDO CÁCERES GONZÁLEZ', '27_OSVALDO CÁCERES GONZÁLEZ.jpg', '/archivos/49_27_OSVALDO CÁCERES GONZÁLEZ.jpg', '/archivos/49_27_OSVALDO CÁCERES GONZÁLEZ_web.jpg', '/archivos/49_27_OSVALDO CÁCERES GONZÁLEZ_min.jpg', '2024-01-28 12:28:46', '2024-01-28 12:28:46');
INSERT INTO archivo VALUES (50, NULL, '28_MIGUEL LAWNER ENTREVISTAS.jpg', 'image/jpeg', 'jpg', 359387, '28_MIGUEL LAWNER ENTREVISTAS', '28_MIGUEL LAWNER ENTREVISTAS.jpg', '/archivos/50_28_MIGUEL LAWNER ENTREVISTAS.jpg', '/archivos/50_28_MIGUEL LAWNER ENTREVISTAS_web.jpg', '/archivos/50_28_MIGUEL LAWNER ENTREVISTAS_min.jpg', '2024-01-28 12:34:52', '2024-01-28 12:34:52');
INSERT INTO archivo VALUES (51, NULL, '29_Goycoolea.jpg', 'image/jpeg', 'jpg', 519977, '29_Goycoolea', '29_Goycoolea.jpg', '/archivos/51_29_Goycoolea.jpg', '/archivos/51_29_Goycoolea_web.jpg', '/archivos/51_29_Goycoolea_min.jpg', '2024-01-28 12:37:09', '2024-01-28 12:37:09');


--
-- Name: archivo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: arpu
--

SELECT pg_catalog.setval('archivo_id_seq', 51, true);


--
-- Data for Name: configuracion; Type: TABLE DATA; Schema: public; Owner: arpu
--



--
-- Name: configuracion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: arpu
--

SELECT pg_catalog.setval('configuracion_id_seq', 1, false);


--
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: arpu
--

INSERT INTO migration VALUES ('m000000_000000_base', 1705668167);
INSERT INTO migration VALUES ('m230819_141401_usuario', 1705668202);
INSERT INTO migration VALUES ('m230819_141502_archivo', 1705668202);
INSERT INTO migration VALUES ('m230901_205009_configuracion', 1705668205);
INSERT INTO migration VALUES ('m240119_130230_publicacion', 1705690281);


--
-- Data for Name: publicacion; Type: TABLE DATA; Schema: public; Owner: arpu
--

INSERT INTO publicacion VALUES (2, 1, 'Alejandro Presente. Memoria desde la Arquitectura', 'Alexander Bustos, Luis Darmendrail, Patricio Zeiss', 'Dostercios', 'Dostercios', '978-956-362-162-4', 'Español', '', '<p>Alejandro Rodríguez Urzúa dejó su marca y herencia en la región del Bío-bío de forma clara y de definitiva, a través de una multiplicidad de actividades no limitadas al mero acto de proyectar. Su vida estuvo llena de matices que pasaron por la arquitectura, la docencia y la política. Hace 40 años fue secuestrado y hecho desaparecer, entre muchos hombres y mujeres, por la fidelidad a sus convicciones.</p><p><br></p><p>A pesar de ello, su testamento permanece vigente. Sus obras construidas, discretas y austeras, nos dan cuenta de un trabajo prolijo y bien planteado, de un diseño que ha trascendido décadas y que sigue despertando admiración. El manejo de los materiales, la funcionalidad, la imagen y la composición son resueltas en un balance y equilibrio expresivo que hace identificar de inmediato una obra suya. Sus obras son la concreción de su pasión por la arquitectura, de su vocación por el servicio público y de sus fuertes ideales sociales. La investigación que origino este texto contó con el aporte de los arquitectos Miguel Lawner, Osvaldo Cáceres, Pedro Tagle, Sonja Friedmann, Ernesto Vilches, Viviana Fernández y de la familia Rodríguez Whipple.</p><p><br></p><p>Esta publicación se encuentra enmarcado en el proyecto Alejandro Presente: Memoria desde la arquitectura que aspira ser un reconocimiento póstumo para el arquitecto Alejandro Rodríguez Urzúa, con la convicción que estamos ante una posibilidad histórica de reconocer, prestigiar y consolidar a uno de los mejores arquitectos de la segunda mitad del siglo XX en Chile. Su obra es paradigma de nuestra modernidad local y modelo de estudios para las actuales y futuras generaciones de arquitectos.</p>', 2016, NULL, NULL, NULL, true, 25, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (1, 1, 'Jorge Lobos', 'Jorge Lobos, Edward Rojas, Humberto Eliash', 'Gustavo Burgos, José Lagos, Ignacio Sáez, Patricio Zeiss', 'dostercios', '978-956-362-714-5', 'Español / Inglés', 'https://dostercios.cl/publicacion/jorge-lobos-entrevistas', '<p>El trabajo de Lobos ha manifestado constantemente una dirección hacia aquello o aquellos que están al margen de lo que fueron las tendencias de investigación de la academia y el quehacer de los arquitectos, tanto en Chile como en el mundo, ámbitos en los que aún predomina, aunque hoy en menor medida, el trabajo formal sin mayores cuestionamientos, centrado en lo artístico y estético. De a poco, los problemas ligados a la sobrepoblación, las enormes desigualdades entre los habitantes de las ciudades, la falta de viviendas y el aumento de las masas migratorias en todo el orbe, han llevado a un cuestionamiento de los enfoques de la profesión, lo que ha puesto en primera línea una serie de temas que hace quince años un número muy reducido de profesionales ya estaba investigando.</p><p><br></p><p>En las entrevistas que aquí se presentan, realizadas durante enero del 2014 y abril del 2016, se evidencia que esta forma de pensar y cuestionar la disciplina, así como la labor del arquitecto en el proyecto, son constantes en el trabajo y discurso de Lobos, un cuestionamiento y forma de trabajo que si bien no es nuevo, en estos momentos cobra un mayor valor, ya que genera nuevas preguntas y aporta a un proceso de cambio de enfoque que ha venido desarrollando muy lentamente la profesión y la academia.</p>', 2016, NULL, NULL, NULL, true, 18, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (6, 1, '5m2', 'Ricardo Azócar, Carolina Catrón', '', 'Dostercios', '978-956-09018-2-8', 'Castellano', '', '<p>AZÓCAR CATRON es un estudio y taller de Arquitectura y Urbanismo fundado en Concepción Chile, el año 2015 por Ricardo Azócar y Carolina Catrón. Ricardo Azócar obtuvo el título de Arquitecto el año 2015 por la Universidad del Bío-Bío. Carolina Catrón obtuvo el título de Arquitecta y el grado de Magister ambos por la Universidad del Bío-Bío el año 2016 y fue distinguida con los premios "Escuela de Arquitectura 2016" y "Mejor Proyecto de Título 2016" El año 2016 obtuvieron el premio "Obra Revelación" otorgado por el Colegio de Arquitectos de Chile delegación Concepción por su proyecto "Dos Torres y un Sendero" el cual, durante el 2018 fue seleccionado en el evento colateral -Young Architects in Latin America- de la XVI Bienal de Arquitectura de Venecia -Freespace-. Ese mismo año, su monografía -Catalejo- (Dostercios 2017), obtuvo el Primer Premio de la XIV Bienal Internacional de Arquitectura de Costa Rica en la categoría publicaciones. Su trabajo ha sido exhibido durante la XX Bienal de Arquitectura y Urbanismo de Chile, en la XIV Bienal Internacional de Arquitectura de Costa Rica y en la XVI Bienal de Arquitectura de Venecia.</p>', 2018, 11, 11, NULL, false, 27, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (26, 1, 'Enjundia', 'Nicolás Valencia', 'Carola Julio Mendoza, Ignacio Sáez Araneda, Patricio Zeiss Pérez', 'Dostercios', '978-956-6142-06-5', 'Castellano', '', '<p>Este fascinante libro es una selección de crónicas y ensayos sobre arquitectura, ciudades y personajes latinoamericanos, donde el autor con su voz honesta y clara, explora nuestros territorios y las vidas que se desenvuelven en ellos.</p><p><br></p><p>En sus páginas descubrimos la historia de un exparamilitar que, con sus propias manos, construye un parque en Medellín, así como la experiencia de un arquitecto autodidacta en la periferia aimara de La Paz. Además, el libro nos sumerge en el mundo de un maestro sandwichero en el corazón de la Vega Central y nos lleva a seguir la travesía de un sobre de levadura que viaja desde Argentina a Chile en plena cuarentena.</p><p><br></p><p>“Nicolás abre una posibilidad a las transformaciones. De barrios, del lenguaje y de las comunidades. Y lo hace desde el aprendizaje en primera persona. En ese sentido, arroja luz donde no había”, plantea la escritora Ariel Florencia Richards en el prólogo.</p>', 2023, 6, 7, NULL, true, 48, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (5, 1, 'Catalejos', 'Ricardo Azócar, Carolina Catrón', '', 'Dostercios', '978-956-09018-0-4', 'Castellano', 'http://www.dostercios.cl/publicacion/catalejo', '<p>Cinco cerros confinan el centro histórico de Concepción, cada cual con su propia forma, escala, contexto e historia. Amarillo, Caracol, Chepe, La Pólvora y la Virgen constituyen los hitos de un invisible recorrido perimetral por la ciudad, el cual rodea otro sendero, aquel que nace entre los cerros de la Universidad de Concepción y avanza por el boulevard Barros Arana hasta el borde del río Biobío, y que paulatinamente se ha consolidado como un trayecto sin retorno, al igual que en rasgo fundamental en el reconocimiento de este tejido urbano como una ciudad fluvial. Cada uno de estos cerros es una referencia para quien transita, tal como un faro en el litoral es un aviso para los navegantes. Es señal y resguardo para quien observa a la distancia, un vigía anónimo provisto, por qué no, de un catalejo. A partir de esa imagen, ideamos una ruta hipotética entre los cerros de Concepción, para que aquel observador pueda recorrerlos, percibiéndolos como destinos que acogen, refugios para contemplar y ser contemplado, permanecer y avanzar, como lugares de encuentro y soledad.</p><p><br></p><p>Concretamente, planteamos aquí una intervención específica para cada cerro, que no pretende actuar como una respuesta definitiva, sino como una pregunta abierta -en lenguaje de proyecto arquitectónico- en relación a un problema aún inexistente: la consolidación de un nuevo recorrido para Concepción. Así, presentamos un objeto autónomo, sólo definido por las leyes que demarcan su contexto inmediato y que exigen que el espacio contenido tenga un uso determinado dentro de los márgenes de su escala y forma. Cada propuesta es, por sí misma, capaz de acentuar u otorgar significado a un lugar, o bien, desde una mirada de conjunto, ser la referencia, la señal, para comenzar, continuar, permanecer o finalizar un nuevo itinerario por los cerros de Concepción</p>', 2017, 9, 6, NULL, false, 26, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (7, 1, 'Tribunales. Sobre una Teoría Moderna', 'Leslie Fernández, Oscar Concha, Ignacio Bisbal, Cristián Berríos, Javier Ramírez H.', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-09018-11', 'Castellano', 'http://www.dostercios.cl/publicacion/tribunales-sobre-una-teoria-moderna', '<p>Tribunales: sobre una teoría moderna se basa en el trabajo curatorial de Leslie Fernández y Óscar Concha desarrollado en el marco del proyecto Móvil, ciclo 2015 / 2016, en el que participaron artistas sonoros, plásticos y visuales, junto a fotógrafos y arquitectos. El libro se compone de conversaciones con los participantes de este ciclo, abordando su aproximación a la teoría moderna, y de ensayos teóricos que estructuran el texto en torno a tres áreas temáticas: urbanismo, diseño arquitectónico y restauración.</p><p><br></p><p>Proponemos leer Tribunales: sobre una teoría moderna como una aproximación retórica sobre el proyecto moderno, y no como un glosario teórico o un catálogo del Edificio Tribunales; buscamos, en este sentido, evidenciar que las reflexiones que se generan en el campo de la arquitectura pueden, ciertamente, verse nutridas de todas las áreas del conocimiento.</p><p><br></p><p>Este trabajo presenta diferentes miradas sobre el edificio Tribunales; una obra con múltiples y diversos significados para la comunidad que lo habita y lo recorre continuamente, para quienes lo viven desde el exterior como parte de su itinerario cotidiano y, desde luego, para la ciudad de Concepción, en un sentido más amplio, como parte de su trama urbana.&nbsp;</p>', 2018, 7, 8, NULL, true, 28, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (8, 1, 'ATLAS. Fragmentos del paisaje. Concepción', 'Grace Mallea, Carolina Rojas', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-09018-3-5', 'Castellano', 'http://dostercios.cl/publicacion/atlas-fragmentos-del-paisaje', '<p>El presente Atlas, tiene por objeto registrar y mostrar mediante un documento gráfico, las características de los agentes del paisaje que componen los ecosistemas penquistas, su estado de conservación y los efectos de fragmentación que generan las diversas dinámicas de transformación del territorio.</p><p><br></p><p>Las cartografías y fichas se basan en los resultados de proyecto URBANCOST y en investigaciones en desarrollo de la investigadora Carolina Rojas y equipo de Centro de Desarrollo Urbano Sustentable (CEDEUS) así como diversos estudios realizados por Centro de Ciencias Ambientales (EULA). De esta manera, el Atlas intenta difundir el conocimiento académico y científico de manera simple y gráfica, poniendo en valor el patrimonio natural (ríos, humedales, lagunas) y urbano (parques) como identidad del paisaje urbano-natural histórico de Concepción y generar conciencia sobre el estado de vulnerabilidad al que están expuestos los cuerpos de agua.</p><p><br></p><p>Los mapas presentados, son una “radiografía” del estado actual de nuestro patrimonio natural y en el caso de lagunas y humedales también se presentan fichas comparativas de la transformación de estos (año 2002-año 2018). Hagamos el ejercicio de desaparecer de Concepción un determinado año (2002 por ejemplo) e imaginemos que impresión nos llevaríamos al volver a nuestra ciudad (hoy), ¿nos impactaría ver los cambios en el paisaje?, esta situación hipotética la vivió y describió Ian McHarg cuando regresó a su tierra natal –Glasgow- tras vivir un largo periodo fuera: “Al regresar a este lugar esperaba encontrar un paraíso reducido, como suele ocurrir con los lugares a los que se vuelve, pero nunca se me ocurrió pensar que lo hubieran borrado del mapa.”</p><p><br></p>', 2019, 1, 0, NULL, true, 29, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (9, 1, 'Osvaldo Cáceres. Entrevistas', 'Gonzalo Cáceres, Jessica Fuentealba, Danny Monsálvez, Laura Bennedetti', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-09018-5-9', 'Castellano', 'https://dostercios.cl/publicacion/osvaldo-caceres-entrevistas', '<p>Esta publicación busca dar a conocer las reflexiones expuestas en las entrevistas realizadas al arquitecto Osvaldo Cáceres durante los años 2013-2017. La relevancia de difundir este material, recae en plasmar en un documento tangible las ideas que originaron parte del patrimonio urbano de la ciudad de Concepción.</p><p><br></p><p>El trabajo realizado por Osvaldo Cáceres a nivel arquitectónico quedó plasmado en gran parte del centro de la ciudad de Concepción, formando parte de una generación de arquitectos que llegan luego del terremoto de 1960 a impregnar la zona con un ideario moderno.</p>', 2019, 2, 1, NULL, true, 30, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (10, 1, 'Roberto Goycoolea. Entrevistas', 'Verónica Esparza, Roberto Goycoolea Prado, Alexander Bustos', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-09018-4-2', 'Castellano', '', '<p>Esta publicación busca dar a conocer las reflexiones expuestas en las entrevistas realizadas al arquitecto Roberto Goycoolea durante los años 2013-2017. La relevancia de difundir este material, recae en plasmar en un documento tangible las ideas que originaron parte del patrimonio urbano de la ciudad de Concepción.</p><p><br></p><p>El trabajo que realizó Roberto Goycoolea implicó una masificación del lenguaje moderno en las calles penquistas, su propuesta comprendió la arquitectura como una expresión no solo técnica o artística, sino también social y que, en consecuencia, dejaron un valioso legado en la ciudad y la región del Biobío.</p>', 2019, 2, 3, NULL, true, 31, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (11, 1, 'Creadoras', 'Javiera Pavez Estrada, Luis Darmendrail Salvo, Andrés Saavedra Araneda, Gustavo Burgos Fuentes', '', 'Dostercios', '978-956-09018-6-6', 'Castellano', '', '<p>En un territorio históricamente marcado por sismos, quiebres y fronteras, la arquitectura se ha manifestado con diversas expresiones a lo largo del tiempo. Una expresión matizada por procesos socioculturales que han definido líneas y posturas que se han traducido en imágenes urbanas y producción arquitectónica.</p><p>Dentro de los muchos cambios vividos en la arquitectura nacional y regional del siglo XX en Chile, nos encontramos con la aparición de la mujer en la profesión, la cual se incorpora desde la creación a diversas aristas asociadas también a la política o el arte, dando cuenta de múltiples inquietudes y convicciones entrelazadas que quedaron grabadas en este territorio y con el pasar de los años, oculta y negada por lecturas monotemáticas y ausentes de crítica.</p><p><br></p><p>Un trabajo complejo llevado a cabo por creadoras que debieron enfrentarse a modelos patriarcales, visiones ignotas y un olvido que con los años se ha revertido en una valoración cada vez más significativa de la labor de las arquitectas del ayer considerando además la participación femenina del presente para así proyectar un futuro equitativo donde esperamos en un corto y mediano plazo no hablemos de “trabajo no visibilizado” sino de simplemente “arquitectura y creación”.</p>', 2019, 7, 5, NULL, false, 32, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (12, 1, 'Isla 01', 'Eduardo Cruces, Manuel Rivera Marz, Colectivo LIGA', 'David Romero, Luis Darmendrail, Felipe Oliver, Oscar Concha, Ignacio Sáez, Patricio Zeiss', 'Dostercios, Almacén Editorial', '2735 - 6000', 'Castellano', 'http://revistaisla.cl', '<p>El oasis neoliberal comenzó a incendiarse, y junto con ello, se quema también el velo de normalidad con el que se encubría una realidad injusta y llena de carencias. Como en toda revuelta, los acontecimientos se han desencadenado de forma vertiginosa cargando de incertidumbre el presente y el futuro; ha sido difícil procesar un estallido que se vive en todos los ámbitos de nuestra experiencia. Con todo, somos testigos y protagonistas de un proceso histórico que puede conducirnos a una transformación de aquello que por mucho tiempo nos fue negado siquiera imaginar: el modo en que habitamos y nos relacionamos dentro de este país. Si bien hace ya tiempo atrás que vemos la necesidad de contar con una publicación que le de espacio a la reflexión crítica de agentes de la cultura local, la contingencia nos empuja con mayor fuerza a trabajar en un proyecto editorial que nos permita poner en circulación el debate en torno a diversas problemáticas que nos conciernen.</p>', 2020, 2, 0, NULL, false, 33, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (13, 1, 'Isla 02', 'Carolina Arriagada, Luis Darmendrail, Cristian Toro, Claudio Bernal', 'David Romero, Luis Darmendrail, Felipe Oliver, Oscar Concha, Ignacio Sáez, Patricio Zeiss', 'dostercios, Almacén Editorial', '2735 - 6000', 'Castellano', 'http://revistaisla.cl', '<p>Ya son casi ocho meses desde que la sociedad chilena despertó y se alzó contra la desigualdad y los abusos de un sistema que por décadas ha imperado en nuestro país. Un proceso concordante con otros a nivel global que evidencia la reacción popular ante el desequilibrio de una pretenciosa globalización y que al mismo tiempo ha sido un retorno del sentido crítico a la sociedad, agotada por la alienación y de que “no todo está bien”.</p><p><br></p><p>La creación siempre despierta ante la reacción y desde octubre pasado hemos visto cómo se han multiplicado las manifestaciones artísticas expresando ese sentir y asociadas también a la población, integrándola y formando un canal de divulgación de las pasiones colectivas. Ocho meses han pasado desde ese estallido y hoy se agrega una pandemia global que ha acentuado los resultados de esta sociedad despolitizada y quebrantada. Barrios y poblaciones que son islas autónomas divididas por calles, autopistas, líneas férreas y tendidos eléctricos, que nacieron de planificaciones débiles pensadas desde un computador o del ignorante trazo de un urbanista que desde las alturas no ha sido capaz de ver la multiplicidad de colores, vidas y modos de habitar de la población en general. Un alejamiento de la realidad del que podemos encontrar además huellas durante la década de 1970 y 1980 bajo el yugo militar que fomentó expulsiones, movimientos forzados y expropiaciones. Una sumatoria de hechos que da como resultado ciudades disgregadas plagadas de voces silenciadas que en la búsqueda de la dignidad y del acceso a derechos básicos se han alzado y unido.</p>', 2020, 5, 3, NULL, false, 34, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (15, 1, 'Situaciones', 'República Portátil', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-09018-8-0', 'Castellano', '', '<p>Situaciones resume parte del trabajo desarrollado por la oficina de arquitectura y diseño República Portátil entre los años 2003 y 2018. Las siete obras que forman parte de este libro son definidas como cuerpos “débiles”, temporales; instalaciones de diferentes escalas que se posicionan en el espacio público para interactuar e intervenir en el cotidiano urbano. Concepción, Arauco, Valparaíso y Chillán han sido el contexto para estas construcciones, generando diversas formas de ocupar e interactuar en los espacios públicos. Así, en estas páginas, las obras se transforman en un relato que busca dar cuenta de las relaciones, conexiones y cambios que una instalación arquitectónica puede provocar en el espacio urbano.</p><p><br></p><p>En el año 2003, República Portátil nace como una comunidad de creativxs relacionadxs de manera transdisciplinar. Sus intereses y obsesiones confluyen en el desarrollo teórico-práctico de proyectos ligados al habitar, la temporalidad de la arquitectura y la producción social del espacio. Entre sus obras se destacan performances, instalaciones de arte, refugios, equipamiento modular y pabellones temporales de mediana y gran escala en el espacio público de ciudades de Chile y el extranjero. Actualmente, República Portátil se encuentra operando desde las ciudades de Concepción, Valdivia, Valparaíso y Santiago de Chile.</p><p><br></p>', 2020, 10, 4, NULL, true, 36, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (16, 1, 'Diagonal Biobío. Emergencia de la escena cultural penquista', 'V.A.', 'Bárbara Lama, Natascha de Cortillas', 'Dostercios', '978-956-09018-7-3', 'Castellano', '', '<p>Diagonal Biobío es un ejercicio editorial que busca contribuir a un cuerpo reflexivo e interdisciplinario de la cultura y las manifestaciones artísticas desarrolladas en el siglo XX- XXI en Concepción. Para ello, nos propone pensar en las injerencias que diversos agentes y políticas públicas han tenido en el desarrollo de las prácticas artísticas de la región como respuesta social de un pueblo que se abre a la discusión respecto de los criterios de identidad que admite nuestra institucionalidad social y educacional. Por ello, este proyecto resulta relevante en la necesidad de poner en valor el patrimonio de la cultura y las artes en Concepción para ampliar la mirada respecto de la escena local e invitar a pensar en las influencias que las artes, en su sentido más laxo, erigen en sus relaciones institucionales y políticas al país.</p>', 2020, 11, 5, NULL, true, 37, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (14, 1, 'Isla 03', 'Alejandra Villaroel, Constanza Hermosilla, Julio Suárez, David Romero', 'David Romero, Luis Darmendrail, Felipe Oliver, Oscar Concha, Ignacio Sáez, Patricio Zeiss', 'Dostercios, Almacén Editorial', '2735 - 6000', 'Castellano', 'http://revistaisla.cl', '<p>Varios meses han transcurrido desde el inicio de un confinamiento de carácter imparcial y que ha puesto en evidencia una serie de situaciones acentuadas por una distancia que va más allá del alejarse un metro y algo más del otro. Así como un deshielo pone en evidencia la roca y lo más pedregoso del relieve, los últimos meses han sido una exposición de una sociedad que ha vivido por mucho tiempo en una abismante separación expresada en un tejido social afectado por el clasismo y la antipatía, cualidades prácticamente estandarizadas que traspasan además esferas de poder e instituciones que han usado el contexto actual para beneficio propio, sin querer perder absolutamente nada. El último tiempo ha sido para muchos vivido de manera remota y virtual, estableciendo una imperativa dependencia con pantallas que además de ser protagonistas de una nueva alienación, han pasado a ser espejos de las almas y ausencias emocionales de una sociedad globalizada y carcomida por un sistema donde todo se digitaliza, desde las acciones más básicas a la expresión de emociones pasando por una búsqueda del placer, llenando vacíos y por supuesto carencias.</p><p><br></p><p>La despolitización presentada en el número anterior no es más que un rasgo más que también se vive en este momento. La ausencia de crítica y cuestionamiento a lo que nos rodea son rasgos que se detectan en esta era de abismos. La publicidad invade las redes apelando a la búsqueda de la felicidad con aplicaciones y sistemas que permiten mantener un estilo de vida que se debe ostentar a través de un teléfono para así seguir el estatus de un influencer. Una sociedad alienada que persiste a través de un eslogan que alude a mayor conectividad pero que en rigor es una digitalización de una tácita segregación y gentrificación.</p><p><br></p>', 2020, 9, 14, NULL, false, 38, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (17, 1, 'Isla 04', 'Leslie Fernández, Orleans Romero, Francisco Bruna, Nicolás Valéncia', 'David Romero, Luis Darmendrail, Felipe Oliver, Oscar Concha, Ignacio Sáez, Patricio Zeiss', 'Dostercios, Almacén Editorial', '2735 - 6000', 'Castellano', 'http://revistaisla.cl', '<p>A pocos días de haber celebrado el plebiscito constitucional y del resonante triunfo del apruebo en las urnas, nos encontramos en un momento decisivo, expectante, dentro del proceso de (re)politización marcado por la revuelta popular de octubre de hace un año atrás. Cuando hablamos de (re)politización nos estamos refiriendo, entre otras cosas, a la recuperación de aquella dimensión de la política que nos ha sido denegada durante décadas: la posibilidad de imaginar, proponer y decidir –por medio de la voluntad popular y sin los amarres que imponen las élites– la forma en que deseamos establecer nuestra vida en común. Las asambleas barriales, las marchas que se tomaron el espacio público y la palabra de los sin voz plasmada en los muros de la ciudad, son todas manifestaciones que nos hablan del vuelco de lo político hacia la vida. Precisamente, porque se trata de algo que rompe con todos los diques impuestos por la institucionalidad transicional, este proceso de reconfiguraciones políticas (colectivas y personales) excede por mucho la lógica electoral. Y si bien el apruebo constituye un triunfo significativo e histórico, también es cierto que no se ha detenido el curso de una revuelta que tiene por horizonte “hasta que la dignidad se haga costumbre”.</p>', 2020, 11, 14, NULL, false, 39, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (18, 1, 'isla 05', 'Carolina Opazo, Paz Alarcón, Camilo Ortega, CAPUT', 'David Romero, Luis Darmendrail, Felipe Oliver, Oscar Concha, Ignacio Sáez, Patricio Zeiss', 'Dostercios, Almacén Editorial', '2735 - 6000', 'Castellano', 'http://revistaisla.cl', '<p>Nuestra experiencia en la ciudad se encuentra en gran parte condicionada, o conducida, por planificaciones urbanas orquestadas desde las oficinas del poder político y económico. Para quienes operan las manijas que inciden en las formas del habitar y del convivir, es el mercado y la desmovilización social lo que debe imponerse a la hora de organizar el espacio. Afortunadamente, esta lógica ha terminado por colisionar contra el hastío y el rechazo masivo de la población; con la revuelta popular de octubre se abrió, como contrapartida, un renovado espacio para la imaginación, el pensamiento y la acción política, en donde el derecho a la ciudad y la autodeterminación de los territorios han tenido un rol protagónico.&nbsp;</p><p><br></p><p>Pero ocurrió que, en pleno desarrollo de estas aperturas y apropiaciones del espacio público, nos vimos repentinamente</p><p><br></p><p>sacudidos por una pandemia global que nos obligó a encerrarnos y a distanciarnos. Confinados en nuestras casas, impedidos de transitar libremente por las calles y sujetos a un toque de queda que ya se extiende por más de un año, experimentamos la realización del control social total que adelantaron las ficciones distópicas del cine y la literatura. Si bien algunas de las medidas gubernamentales han sido necesarias para frenar la ola de contagios, a lo que apuntamos es al peligro de terminar normalizando el estado de excepción. Debemos insistir, hoy más que nunca, en imaginar nuevas formas de habitar, percibir y compartir los espacios que nos son comunes, si no queremos seguir sometidos a este régimen punitivo de la hipervigilancia en el futuro.</p>', 2020, 11, 29, NULL, false, 40, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (19, 1, 'Maco Gutiérrez. Hacia una Arquitectura en la casa grande', 'Alexander Bustos Concha, Luis Darmendrail Salvo, Patricio Zeiss Pérez', '', 'Dostercios', '978-956-09018-9-7', 'Castellano', '', '<p>El presente trabajo ofrece un registro panorámico de la vida y obra del arquitecto Javier Lisímaco Gutiérrez (1928-1972), repartida entre Chile, Cuba y Bolivia. La mayoría del material es inédito, reunido gracias a la colaboración de instituciones y numerosas personas, que nos han compartido generosamente la memoria de sus vivencias.</p><p><br></p><p>La inquietud por contar esta historia nació ante el hecho inusual de su paso por tres países, participando de procesos históricos que agitaron el continente; y del reconocimiento a la distintiva exploración dejada en nuestra zona, que en un marco cotidiano y con una economía de recursos, incorpora sutilezas que destacan en el paisaje urbano.</p><p><br></p><p>En estas páginas veremos cómo su concepción moderna del espacio transita desde una expresión plástica abstracta a una donde van infiltrándose las tradiciones del lugar. Por otro lado, vemos a un arquitecto que elabora su obra no sólo como mero encargo profesional, sino sobre todo como soporte de un tejido social, escenario de experiencias compartidas por una comunidad.</p><p><br></p><p>Maco Gutiérrez. Hacia una arquitectura en la casa grande plantea un hilo de continuidad que amarra el trabajo de un arquitecto por países que, más allá de sus particularidades, compartían la misma lucha por integrar a todos sus habitantes a los beneficios de la modernización. Hoy, cuando estallidos sociales y una pandemia global muestran en todo su ancho la fragilidad de nuestra América, ¿qué caminos compartidos es posible trazar? ¿Qué relatos volverán a insuflar la utopía de la dignidad?</p><p><br></p>', 2021, 1, 4, NULL, true, 41, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (20, 1, 'Concepción 1930', 'Luis Darmendrail Salvo', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-6142-00-3', 'Castellano', '', '<p>Estas páginas son depositarias de un recorrido por diferentes capas de una ciudad de la que poco queda o podríamos imaginar, conformando un relato que recorre una época de la que nos separa casi un siglo. La década de 1930 se presenta como una de años convulsos, de cambios e inicios, en que la cultura, el comercio, los medios y las instituciones son pilares de una vida urbana que fluye junto a la narración, dando cuenta de una ciudad de comienzos de siglo. Luis Darmendrail nos entrega una investigación contundente, relevando una parte de la historia de Concepción que no ha sido tratada con el ahínco que merece. Aquí confluyen datos bibliográficos, archivos, años de recorridos por la ciudad y, sobre todo, una pasión por dejar evidencia de la historia urbana de esta ciudad, de nuestra memoria colectiva.</p>', 2022, 2, 3, NULL, true, 42, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (21, 1, 'Chillán Moderno. Detalle fotográfico', 'Rodrigo Vera Manríquez', '', 'Dostercios', '978-956-6142-03-4', 'Castellano', '', '<p>Este libro es el resultado de un proceso de investigación creación visual centrado en la arquitectura moderna de Chillán desde el detalle fotográfico, que intenta recuperar de manera contemporánea el sentido de una visualidad de vanguardia.&nbsp;</p><p><br></p><p>Con esto me refiero particularmente a las manifestaciones del arte, la arquitectura y el diseño que se dieron a principios del siglo xx y marcaron para siempre la concepción que se tenía de estas disciplinas. De manera más específica, se trata de una propuesta basada en el racionalismo expresado en la visualidad; trabajar la geometría como orden estructurante de un entorno que se registra fotográficamente para finalmente ser expresado en la gráfica.&nbsp;</p><p>Ahí se encuentra el núcleo del proyecto: el diálogo que se establece entre la arquitectura moderna de Chillán, la propuesta fotográfica y su expresión en el soporte libro; todo esto con la pintura geométrica como referencia externa. El trabajo de los maestros de la vanguardia se caracterizó por su experimentalidad y por diluir ciertas barreras disciplinares antiguamente existentes entre el arte, la arquitectura y el diseño.&nbsp;</p><p><br></p><p>Se trató de una forma de pensar visual y utilitariamente un nuevo mundo, mediado por los procesos industriales y la búsqueda de la funcionalidad de ese lenguaje geométrico. Esto último se puede emparentar con la arquitectura moderna de Chillán que apareció en el proceso de reconstrucción luego del terremoto de 1939, en que dominan formas geométricas definidas y la ausencia de ornamentación.</p>', 2022, 4, 7, NULL, true, 43, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (22, 1, 'XFORMAS. de hacer Arquitectura', 'Ethel Barahona, Nicolás Valencia, Fabiola González, Yair Estay, Fernando Portal', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-6142-01-0', 'Castellano, Inglés', '', '<p>Esta publicación parece ser tan diversa y flexible como el proyecto del que da cuenta. Un proyecto diseñado bajo reglas autoimpuestas a partir de interrogantes personales de su equipo gestor, cuyos intereses conscientemente parecen conectar biográficamente con su generación: el descrédito de esa figura rotulada como Starchitect, el surgimiento en parte del continente americano de una nueva idea de práctica arquitectónica situada; la falta de referentes laborales de arquitectas y arquitectos que no diseñan edificios y la sensación de que la arquitectura es una carrera universitaria que define un destino según quien la estudia más que lo que realmente posibilita, generando un choque entre la práctica / estudiar. Estos intereses se han visto influenciado por los cambios sociales / culturales de comienzo de siglo, las crisis políticas y una economía global a la baja, generado reflexiones criticas sobre la profesión. Las dos partes que forman esta publicación, distribuidas en dos libros independientes pero complementarios, dan cuenta de las múltiples posibilidades de #XFORMAS, de sus derivados y de las interrogantes frente a la disciplina.</p><p><br></p><p>En el Tomo I encontramos tres conversaciones en torno a los temas que rondaron la planificación de las sesiones: Academia, Mercado y Práctica. En un mix a partir de las seis sesiones de #XFORMAS, veinticuatro participantes de tres países distintos, hablan desde su forma de hacer arquitectura, maneras diversas, pero que coinciden siempre en la búsqueda por darle una vuelta al campo profesional, frente a una enseñanza universitaria de estructura rígida y cerrada en posibilidades. Junto a esto, una conversación entre los tres gestores de este trabajo ahonda en sus inicios y el proceso desarrollado hasta la fecha. El Tomo II presenta cinco ensayos desarrollados por el equipo del proyecto y dos invitados, que giran, de forma libre, en torno a los temas surgidos en el transcurso de #XFORMAS. Así, Valencia da cuenta de los orígenes del formato de las sesiones, de sus relaciones con lo performático, el teatro y el ritmo televisivo, al tiempo que desliza una crítica al evento arquitectónico tradicional. A partir de una de las reglas que fueron base en la formulación de cada sesión, la paridad de género, González reflexiona sobre las instancias que han ayudado a visibilizar, y aquellas que han perpetuado la invisibilización, del trabajo de mujeres en arquitectura. Por su parte, Estay se enfoca en el campo laboral, y cómo el desarrollo de la carrera en las universidades hasta el inicio de la vida laboral, fomentan la precariedad de arquitectas y arquitectos jóvenes. Ya desde fuera del núcleo de este proyecto, Ethel Baraona rescata un manifiesto publicado en 1969 por un colectivo de estudiantes de diferentes universidades estadounidenses para establecer una serie de relaciones entre movimientos civiles, cambios en la formación universitaria y nuevas formas de relacionarnos que vuelven hoy a resonar y poner en cuestionamiento el rol de la arquitectura como profesión. Siguiendo este hilo, pero desde una reflexión más teórica, Fernando Portal imagina la posibilidad de lograr otras formas de hacer arquitectura desde la superación del ideario moderno, en pos de formas subalternas, humildes, fuera de los campos de acción del poder y que rehúyan de una visión hegemónica, formas nuevas que dejen de buscar lo nuevo.</p><p><br></p><p>En #XFORMAS de hacer arquitectura, la forma engloba lo que se hace y el como, generando un proyecto que pone la atención en las transformaciones y deformaciones de una disciplina enfrentada a cambios constantes en los cuales la idea de Un Caja de Herramientas como base de la profesión parece ser, por el momento, la forma más optimista -e interesante-de asumirla.</p>', 2022, 7, 7, NULL, true, 44, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (23, 1, 'Encargos Comunes', 'Fabiola González, Yair Estay', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-6142-02-7', 'Castellano', '', '<p>“Encargos Comunes” se presenta como un proyecto editorial que resume, a partir de tres obras de arquitectura, la práctica e investigación desarrollada por la oficina de arquitectura Taller25 en torno a esta profesión y su vínculo con la clase media contemporánea chilena. Estas obras identifican y visibilizan tres demandas sobre la vivienda: una Construcción nueva, una Reforma y una Ampliación, realizadas en comunas que normalmente se conocen como “Pericentrales” y “Periféricas” de la región Metropolitana (Lo Prado, San Bernardo y Maipú), cuyos mandantes o dueñas/os se inscriben en lo que estadísticamente se define como la clase media, transformándose así en un compendio atípico dentro de la disciplina de la arquitectura. De esta manera, la publicación propone una discusión crítica sobre la producción de la vivienda, y no de cualquier vivienda, sino de las más comunes de todas y, paradójicamente, menos abordadas desde el campo editorial y de divulgación en el área, como pueden ser las operaciones sobre la vivienda de y para los sectores medios.</p>', 2022, 8, 6, NULL, true, 45, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (24, 1, 'La Arquitecta del Desierto.  Visión y Obra de Magdalena "Cuca" Gutiérrez', 'Camilo Giribas Contreras, Amanda Rivera Vidal, Luis Alfaro Jaime', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-6142-04-1', 'Castellano', '', '<p>La arquitecta del desierto es el resultado de un trabajo de investigación sobre la visión y obra de la arquitecta Magdalena “Cuca” Gutiérrez. Magdalena, es reconocida por sus obras diseñadas y construidas con tierra en San Pedro de Atacama (Chile), las cuales muestran la influencia de las construcciones vernáculas del desierto de Atacama y su reinterpretación de manera contemporánea. Su compromiso con el territorio y las comunidades Atacameñas, y su defensa por los sistemas constructivos tradicionales con tierra, la transformaron en un referente en el uso de este material y la hicieron obtener reconocimientos tanto a nivel nacional como internacional. A pocos años de su fallecimiento, este libro muestra el recorrido y legado de Magdalena Gutiérrez en el campo de la arquitectura, y como pionera de la construcción con tierra a nivel nacional. Nos recuerda lo especial que fue y las huellas que dejó a toda y todos quienes tuvimos la oportunidad de conocerla. ¡Buen viaje querida Cuca!</p>', 2023, 2, 8, NULL, true, 46, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (25, 1, 'Humedales Urbanos.  Cartas de la academia a la política pública', 'Carolina Rojas Quezada', 'Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-6142-05-8', 'Castellano', '', '<p>¿Qué es un humedal urbano? ¿Cuál es su valor? ¿Hay humedales en mi ciudad? Las columnas reunidas en este libro ayudan a aguzar la mirada y descubrir el valor de estos ecosistemas claves para el bienestar, desarrollo sustentable y la adaptación al cambio climático. Estas páginas resumen parte del compromiso de la autora con la difusión de sus hallazgos científicos y con su cariño y respeto por la naturaleza.</p>', 2023, 3, 3, NULL, true, 47, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (27, 1, 'Osvaldo Cáceres González.  Un Arquitecto frente a su época', 'Alexander Bustos, Luis Darmendrail, Patricio Zeiss', '', 'Dostercios', '978-956-614-207-2', 'Castellano', '', '<p>Luego de perfilar la trayectoria de Alejandro Rodríguez Urzúa y Javier “Maco” Gutiérrez, este tercer y último tomo de nuestra serie lo dedicamos a Osvaldo Cáceres González (1926-2022), profesional contemporáneo a ellos, compañero de proyectos y de caminos, integrante de una generación de arquitectos conscientes de su época, quienes fueron más allá de lo establecido, expresando sus inquietudes, inconformismos y críticas, llevando carreras multidimensionales y dejando legados que trascienden.&nbsp;</p><p><br></p><p>Osvaldo, el único entre los tres cuya vida no fue apagada por las últimas dictaduras, permaneció vigente y activo por más de siete décadas, sorteando los sucesivos cambios políticos, sociales y culturales experimentados en Chile durante la segunda mitad del siglo XX y principios del siglo XXI. Su longevidad e incansable capacidad de trabajo hacen que su obra sea inabarcable en un solo volumen. Por eso, a diferencia de nuestros trabajos anteriores, monografías exhaustivas de la vida y obra de sus protagonistas, en las siguientes páginas sólo aspiramos a esbozar un relato sobre la forma en que él se planteó frente a su época, en cada etapa de su carrera, viendo la arquitectura como expresión cultural que atraviesa y conecta varias capas de conocimiento, bajo el hilo conductor de la valoración de la dignidad humana.&nbsp;</p><p><br></p><p>Hoy en día, cuando la amenaza de autodestrucción ya no es por las guerras atómicas, sino por la desmesura de un sistema opuesto a la sostenibilidad de la vida en la tierra, la posición que el arquitecto toma frente a su época nos interpela directamente.</p>', 2023, 10, 8, NULL, true, 49, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (28, 1, 'Miguel Lawner. Entrevistas', 'Leslie Fernandez, Camila Cociña, Historia arquitectónica Concepción', 'Luis Darmendrail, Ignacio Sáez, Patricio Zeiss', 'Dostercios', '978-956-61420-8-9', 'Castellano', '', '<p>Esta publicación busca dar a conocer las reflexiones expuestas en las entrevistas realizadas al arquitecto Miguel Lawner Steiman durante los años 2014-2017. Este material revisa tanto el pensamiento como la obra de este arquitecto, en distintos momentos y a partir de diferentes contextos. Una revisión, que junto a textos que complementan las ideas y los momentos históricos que aborda Lawner, logran dar forma a un documento que, desde distintas aristas, entrega un testimonio de un momento histórico para la arquitectura en chile.</p>', 2023, 11, 19, NULL, true, 50, true, NULL, NULL, NULL, NULL);
INSERT INTO publicacion VALUES (29, 1, 'Roberto Goycoolea Infante. El hogar como proyecto', '', 'Cristian Berrios, Veronica Esparza', 'Dostercios', '978-956-416-504-2', 'Castellano', '', '<p>El acto de proyectar en arquitectura es por antonomasia prever, para bien o para mal, que los actos de la vida ocurran bajo la configuración de formas y materiales que definen espacios y sus relaciones. Si bien esta escueta definición de proyectar puede abrir extensos debates, es atingente con el título de este libro: la voluntad de dar forma al espacio que da cobijo a la vida íntima de un grupo de personas reunidas por lazos afectivos. Este breve axioma sirve para diferenciar entre el acto de proyectar un hogar y el de proyectar una casa. Un hogar contiene lo que entendemos por casa, pero no siempre una casa llega a constituir un hogar. La casa deviene, idealmente, del oficio del buen construir, del conocimiento de las cualidades de los materiales, de la estabilidad de la estructura, del confort térmico, de los criterios de concepción formal, etc. Para que una casa se convierta además en hogar, se requiere de un manejo sensible en la organización de los recintos que la conforman y de como estos se relacionan entre sí y con quienes los habitan.&nbsp;</p><p><br></p><p>Esto permitió a Goycoolea dar forma a la idea del hogar, incluyendo en sus propuestas arquitectónicas los anhelos y también los recuerdos de sus futuros moradores, promoviendo un sentido de pertenencia y arraigo en cada una de estas viviendas. En muchas de ellas sus actuales moradores son todavía los habitantes originales. Es quizás esta evidencia, y el aprecio que se muestra en sus testimonios, lo que amerita detener la mirada sobre esta arquitectura sobria, y hasta la fecha desconocida, en el vasto legado de Roberto Goycoolea Infante.</p>', 2023, 11, 26, NULL, true, 51, true, NULL, NULL, NULL, NULL);


--
-- Name: publicacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: arpu
--

SELECT pg_catalog.setval('publicacion_id_seq', 29, true);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: arpu
--

INSERT INTO usuario VALUES (1, 1, 'Mario', 'Vial', '$2y$13$SOpCSInngrwt8dA4/ttLzu5eutRyipXmw/PacyfMwYxNYjtBHm.Fq', 'mariovials@gmail.com', 'ixX3vASoCP_1WAN8GxTt1t2X_uDHMbMD', '2024-01-19 10:50:17', '2024-01-19 10:50:17');
INSERT INTO usuario VALUES (2, 1, 'Ignacio', 'Sáez', '$2y$13$zKkqkIQIH9jjqu/dZTNuzOl9Y2DXHh26b/lIeECVBfieiptBywo7e', 'ignaciosaezaraneda@gmail.com', 'Cx7pxklSg3VGCOEDgZ4zQKpRkBwDnnza', '2024-01-26 18:23:59', '2024-01-26 18:23:59');


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: arpu
--

SELECT pg_catalog.setval('usuario_id_seq', 2, true);


--
-- Name: archivo_pkey; Type: CONSTRAINT; Schema: public; Owner: arpu; Tablespace:
--

ALTER TABLE ONLY archivo
    ADD CONSTRAINT archivo_pkey PRIMARY KEY (id);


--
-- Name: configuracion_pkey; Type: CONSTRAINT; Schema: public; Owner: arpu; Tablespace:
--

ALTER TABLE ONLY configuracion
    ADD CONSTRAINT configuracion_pkey PRIMARY KEY (id);


--
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: arpu; Tablespace:
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- Name: publicacion_pkey; Type: CONSTRAINT; Schema: public; Owner: arpu; Tablespace:
--

ALTER TABLE ONLY publicacion
    ADD CONSTRAINT publicacion_pkey PRIMARY KEY (id);


--
-- Name: usuario_correo_electronico_key; Type: CONSTRAINT; Schema: public; Owner: arpu; Tablespace:
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_correo_electronico_key UNIQUE (correo_electronico);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: arpu; Tablespace:
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: configuracion-codigo-tipo_php-index; Type: INDEX; Schema: public; Owner: arpu; Tablespace:
--

CREATE INDEX "configuracion-codigo-tipo_php-index" ON configuracion USING btree (codigo, tipo_php);


--
-- Name: fk-publicacion-archivo_id-archivo-id; Type: FK CONSTRAINT; Schema: public; Owner: arpu
--

ALTER TABLE ONLY publicacion
    ADD CONSTRAINT "fk-publicacion-archivo_id-archivo-id" FOREIGN KEY (archivo_id) REFERENCES archivo(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: archivo; Type: ACL; Schema: public; Owner: arpu
--

REVOKE ALL ON TABLE archivo FROM PUBLIC;
REVOKE ALL ON TABLE archivo FROM arpu;
GRANT ALL ON TABLE archivo TO arpu;
GRANT ALL ON TABLE archivo TO arpu;


--
-- Name: archivo_id_seq; Type: ACL; Schema: public; Owner: arpu
--

REVOKE ALL ON SEQUENCE archivo_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE archivo_id_seq FROM arpu;
GRANT ALL ON SEQUENCE archivo_id_seq TO arpu;
GRANT ALL ON SEQUENCE archivo_id_seq TO arpu WITH GRANT OPTION;


--
-- Name: configuracion; Type: ACL; Schema: public; Owner: arpu
--

REVOKE ALL ON TABLE configuracion FROM PUBLIC;
REVOKE ALL ON TABLE configuracion FROM arpu;
GRANT ALL ON TABLE configuracion TO arpu;
GRANT ALL ON TABLE configuracion TO arpu;


--
-- Name: migration; Type: ACL; Schema: public; Owner: arpu
--

REVOKE ALL ON TABLE migration FROM PUBLIC;
REVOKE ALL ON TABLE migration FROM arpu;
GRANT ALL ON TABLE migration TO arpu;
GRANT ALL ON TABLE migration TO arpu;


--
-- Name: publicacion; Type: ACL; Schema: public; Owner: arpu
--

REVOKE ALL ON TABLE publicacion FROM PUBLIC;
REVOKE ALL ON TABLE publicacion FROM arpu;
GRANT ALL ON TABLE publicacion TO arpu;
GRANT ALL ON TABLE publicacion TO arpu;


--
-- Name: publicacion_id_seq; Type: ACL; Schema: public; Owner: arpu
--

REVOKE ALL ON SEQUENCE publicacion_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE publicacion_id_seq FROM arpu;
GRANT ALL ON SEQUENCE publicacion_id_seq TO arpu;
GRANT ALL ON SEQUENCE publicacion_id_seq TO arpu WITH GRANT OPTION;


--
-- Name: usuario; Type: ACL; Schema: public; Owner: arpu
--

REVOKE ALL ON TABLE usuario FROM PUBLIC;
REVOKE ALL ON TABLE usuario FROM arpu;
GRANT ALL ON TABLE usuario TO arpu;
GRANT ALL ON TABLE usuario TO arpu;


--
-- Name: usuario_id_seq; Type: ACL; Schema: public; Owner: arpu
--

REVOKE ALL ON SEQUENCE usuario_id_seq FROM PUBLIC;
REVOKE ALL ON SEQUENCE usuario_id_seq FROM arpu;
GRANT ALL ON SEQUENCE usuario_id_seq TO arpu;
GRANT ALL ON SEQUENCE usuario_id_seq TO arpu WITH GRANT OPTION;


--
-- PostgreSQL database dump complete
--
