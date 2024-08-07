PGDMP  *        
            |            clinica    16.3    16.3 �    z           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            {           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            |           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            }           1262    17291    clinica    DATABASE     }   CREATE DATABASE clinica WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Honduras.1252';
    DROP DATABASE clinica;
                postgres    false            �            1259    17292    tbl_agresor    TABLE     u   CREATE TABLE public.tbl_agresor (
    id_agresor integer NOT NULL,
    nom_agresor character varying(50) NOT NULL
);
    DROP TABLE public.tbl_agresor;
       public         heap    postgres    false            ~           0    0    TABLE tbl_agresor    COMMENT     o   COMMENT ON TABLE public.tbl_agresor IS 'en esta tabla se agregaran los agresores utilizados en la aplicacion';
          public          postgres    false    215            �            1259    17295    tbl_agresor_id_agresor_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_agresor_id_agresor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tbl_agresor_id_agresor_seq;
       public          postgres    false    215                       0    0    tbl_agresor_id_agresor_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tbl_agresor_id_agresor_seq OWNED BY public.tbl_agresor.id_agresor;
          public          postgres    false    216            �            1259    17296    tbl_citaciones    TABLE       CREATE TABLE public.tbl_citaciones (
    numero_caso character varying(10) NOT NULL,
    tipo_citacion character varying(15) NOT NULL,
    fecha_recep_citacion date NOT NULL,
    fecha_citacion date NOT NULL,
    medico integer NOT NULL,
    lugar_citacion character varying(255)
);
 "   DROP TABLE public.tbl_citaciones;
       public         heap    postgres    false            �            1259    17299    tbl_departamento    TABLE     ~   CREATE TABLE public.tbl_departamento (
    id_departamento integer NOT NULL,
    nombre_departamento character varying(50)
);
 $   DROP TABLE public.tbl_departamento;
       public         heap    postgres    false            �            1259    17302 $   tbl_departamento_id_departamento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_departamento_id_departamento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_departamento_id_departamento_seq;
       public          postgres    false    218            �           0    0 $   tbl_departamento_id_departamento_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_departamento_id_departamento_seq OWNED BY public.tbl_departamento.id_departamento;
          public          postgres    false    219            �            1259    17303    tbl_dependencia    TABLE     �   CREATE TABLE public.tbl_dependencia (
    id_dependencia integer NOT NULL,
    nom_dependencia character varying(80) NOT NULL
);
 #   DROP TABLE public.tbl_dependencia;
       public         heap    postgres    false            �           0    0    TABLE tbl_dependencia    COMMENT     ~   COMMENT ON TABLE public.tbl_dependencia IS 'en esta tabla se agregaran las dependencias que solicitan analisis a la clinica';
          public          postgres    false    220            �            1259    17306 "   tbl_dependencia_id_dependencia_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_dependencia_id_dependencia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_dependencia_id_dependencia_seq;
       public          postgres    false    220            �           0    0 "   tbl_dependencia_id_dependencia_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_dependencia_id_dependencia_seq OWNED BY public.tbl_dependencia.id_dependencia;
          public          postgres    false    221            �            1259    17307    tbl_dictamenes    TABLE     F  CREATE TABLE public.tbl_dictamenes (
    numero_caso character varying(10) NOT NULL,
    medico integer NOT NULL,
    fecha_evaluacion date,
    autoridad_solicitante character varying(100) NOT NULL,
    tipo_documento character varying(15) NOT NULL,
    fecha_entrega date NOT NULL,
    datos_extra character varying(255)
);
 "   DROP TABLE public.tbl_dictamenes;
       public         heap    postgres    false            �            1259    17310    tbl_escolaridad    TABLE     �   CREATE TABLE public.tbl_escolaridad (
    id_escolaridad integer NOT NULL,
    nom_escolaridad character varying(30) NOT NULL
);
 #   DROP TABLE public.tbl_escolaridad;
       public         heap    postgres    false            �            1259    17313 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_escolaridad_id_escolaridad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_escolaridad_id_escolaridad_seq;
       public          postgres    false    223            �           0    0 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_escolaridad_id_escolaridad_seq OWNED BY public.tbl_escolaridad.id_escolaridad;
          public          postgres    false    224            �            1259    17314    tbl_estado_civil    TABLE     x   CREATE TABLE public.tbl_estado_civil (
    id_estado_civil integer NOT NULL,
    nom_sexo character varying NOT NULL
);
 $   DROP TABLE public.tbl_estado_civil;
       public         heap    postgres    false            �            1259    17319 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_estado_civil_id_estado_civil_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_estado_civil_id_estado_civil_seq;
       public          postgres    false    225            �           0    0 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_estado_civil_id_estado_civil_seq OWNED BY public.tbl_estado_civil.id_estado_civil;
          public          postgres    false    226            �            1259    17320    tbl_estados    TABLE     o   CREATE TABLE public.tbl_estados (
    id_estado integer NOT NULL,
    nom_estado character varying NOT NULL
);
    DROP TABLE public.tbl_estados;
       public         heap    postgres    false            �            1259    17325    tbl_estados_id_estado_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_estados_id_estado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tbl_estados_id_estado_seq;
       public          postgres    false    227            �           0    0    tbl_estados_id_estado_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tbl_estados_id_estado_seq OWNED BY public.tbl_estados.id_estado;
          public          postgres    false    228            �            1259    17326    tbl_evaluacion    TABLE     q  CREATE TABLE public.tbl_evaluacion (
    consentimiento_informado character varying(30) NOT NULL,
    instrumento_agresion integer,
    descripcion_evaluacion character varying(255),
    relacion_agresor character varying(15),
    especificar_relacion character varying(15),
    sede_evaluacion integer,
    fecha_finalizacion date,
    id_proveido integer NOT NULL
);
 "   DROP TABLE public.tbl_evaluacion;
       public         heap    postgres    false            �            1259    17329    tbl_evaluado    TABLE     m  CREATE TABLE public.tbl_evaluado (
    id_evaluado integer NOT NULL,
    nombre_evaluado character varying(50) NOT NULL,
    apellido_evaluado character varying(50) NOT NULL,
    dni_evaluado character varying(15) NOT NULL,
    telefono_evaluado character varying(15) NOT NULL,
    id_sexo integer NOT NULL,
    edad integer NOT NULL,
    diversidad character varying(20),
    tiempo character varying(10) NOT NULL,
    nombre_acompanante character varying(50) NOT NULL,
    apellido_acompanante character varying(50) NOT NULL,
    relacion_acompanante character varying(20) NOT NULL,
    id_proveido integer NOT NULL
);
     DROP TABLE public.tbl_evaluado;
       public         heap    postgres    false            �            1259    17332    tbl_evaluado_id_evaluado_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_evaluado_id_evaluado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.tbl_evaluado_id_evaluado_seq;
       public          postgres    false    230            �           0    0    tbl_evaluado_id_evaluado_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.tbl_evaluado_id_evaluado_seq OWNED BY public.tbl_evaluado.id_evaluado;
          public          postgres    false    231            �            1259    17333 	   tbl_hecho    TABLE     �   CREATE TABLE public.tbl_hecho (
    id_departamento integer,
    id_municipio integer,
    localidad character varying(100),
    lugar_hecho character varying(30),
    fecha_hecho date,
    id_proveido integer NOT NULL
);
    DROP TABLE public.tbl_hecho;
       public         heap    postgres    false            �            1259    17336    tbl_instrumento    TABLE     �   CREATE TABLE public.tbl_instrumento (
    id_instrumento integer NOT NULL,
    nom_intrumento character varying(50) NOT NULL
);
 #   DROP TABLE public.tbl_instrumento;
       public         heap    postgres    false            �            1259    17339 "   tbl_instrumento_id_instrumento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_instrumento_id_instrumento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_instrumento_id_instrumento_seq;
       public          postgres    false    233            �           0    0 "   tbl_instrumento_id_instrumento_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_instrumento_id_instrumento_seq OWNED BY public.tbl_instrumento.id_instrumento;
          public          postgres    false    234            �            1259    17340    tbl_jornada    TABLE     h   CREATE TABLE public.tbl_jornada (
    id_jornada integer NOT NULL,
    nom_jornada character varying
);
    DROP TABLE public.tbl_jornada;
       public         heap    postgres    false            �            1259    17345    tbl_jornada_id_jornada_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_jornada_id_jornada_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tbl_jornada_id_jornada_seq;
       public          postgres    false    235            �           0    0    tbl_jornada_id_jornada_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tbl_jornada_id_jornada_seq OWNED BY public.tbl_jornada.id_jornada;
          public          postgres    false    236            �            1259    17346    tbl_municipio    TABLE     �   CREATE TABLE public.tbl_municipio (
    id_municipio integer NOT NULL,
    nombre_municipio character varying(100),
    id_departamento integer NOT NULL
);
 !   DROP TABLE public.tbl_municipio;
       public         heap    postgres    false            �            1259    17349    tbl_municipio_id_municipio_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_municipio_id_municipio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tbl_municipio_id_municipio_seq;
       public          postgres    false    237            �           0    0    tbl_municipio_id_municipio_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tbl_municipio_id_municipio_seq OWNED BY public.tbl_municipio.id_municipio;
          public          postgres    false    238            �            1259    17350    tbl_nacionalidad    TABLE     �   CREATE TABLE public.tbl_nacionalidad (
    id_nacionalidad integer NOT NULL,
    nom_nacionalidad character varying(30) NOT NULL
);
 $   DROP TABLE public.tbl_nacionalidad;
       public         heap    postgres    false            �            1259    17353 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq;
       public          postgres    false    239            �           0    0 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq OWNED BY public.tbl_nacionalidad.id_nacionalidad;
          public          postgres    false    240            �            1259    17354    tbl_ocupaciones    TABLE     }   CREATE TABLE public.tbl_ocupaciones (
    id_ocupacion integer NOT NULL,
    nom_ocupacion character varying(20) NOT NULL
);
 #   DROP TABLE public.tbl_ocupaciones;
       public         heap    postgres    false            �            1259    17357     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq;
       public          postgres    false    241            �           0    0     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq OWNED BY public.tbl_ocupaciones.id_ocupacion;
          public          postgres    false    242            �            1259    17358    tbl_proveidos    TABLE       CREATE TABLE public.tbl_proveidos (
    id_proveidos integer NOT NULL,
    num_caso character varying(10) NOT NULL,
    num_caso_ext character varying(10),
    fech_emi_soli date NOT NULL,
    fech_recep_soli date NOT NULL,
    fiscalia_remitente integer NOT NULL
);
 !   DROP TABLE public.tbl_proveidos;
       public         heap    postgres    false            �            1259    17361    tbl_proveidos_id_proveidos_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_proveidos_id_proveidos_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tbl_proveidos_id_proveidos_seq;
       public          postgres    false    243            �           0    0    tbl_proveidos_id_proveidos_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tbl_proveidos_id_proveidos_seq OWNED BY public.tbl_proveidos.id_proveidos;
          public          postgres    false    244            �            1259    17362    tbl_puestos    TABLE     �   CREATE TABLE public.tbl_puestos (
    id_puesto integer NOT NULL,
    nom_puesto character varying(25) NOT NULL,
    estado character varying(25) NOT NULL
);
    DROP TABLE public.tbl_puestos;
       public         heap    postgres    false            �            1259    17365    tbl_puestos_id_puesto_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_puestos_id_puesto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tbl_puestos_id_puesto_seq;
       public          postgres    false    245            �           0    0    tbl_puestos_id_puesto_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tbl_puestos_id_puesto_seq OWNED BY public.tbl_puestos.id_puesto;
          public          postgres    false    246            �            1259    17366    tbl_reconocimiento    TABLE     �   CREATE TABLE public.tbl_reconocimiento (
    id_reconocimiento integer NOT NULL,
    nom_reconocimiento character varying(60) NOT NULL
);
 &   DROP TABLE public.tbl_reconocimiento;
       public         heap    postgres    false            �            1259    17369 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ?   DROP SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq;
       public          postgres    false    247            �           0    0 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE OWNED BY     u   ALTER SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq OWNED BY public.tbl_reconocimiento.id_reconocimiento;
          public          postgres    false    248            �            1259    17370 	   tbl_roles    TABLE     k   CREATE TABLE public.tbl_roles (
    id_rol integer NOT NULL,
    nom_rol character varying(20) NOT NULL
);
    DROP TABLE public.tbl_roles;
       public         heap    postgres    false            �            1259    17373    tbl_roles_id_rol_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_roles_id_rol_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.tbl_roles_id_rol_seq;
       public          postgres    false    249            �           0    0    tbl_roles_id_rol_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.tbl_roles_id_rol_seq OWNED BY public.tbl_roles.id_rol;
          public          postgres    false    250            �            1259    17374 	   tbl_sedes    TABLE     �   CREATE TABLE public.tbl_sedes (
    id_sede integer NOT NULL,
    fk_departamento integer NOT NULL,
    fk_municipio integer NOT NULL,
    ubucacion character varying(60) NOT NULL
);
    DROP TABLE public.tbl_sedes;
       public         heap    postgres    false            �            1259    17377    tbl_sedes_id_sede_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_sedes_id_sede_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tbl_sedes_id_sede_seq;
       public          postgres    false    251            �           0    0    tbl_sedes_id_sede_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tbl_sedes_id_sede_seq OWNED BY public.tbl_sedes.id_sede;
          public          postgres    false    252            �            1259    17378    tbl_sexo    TABLE     h   CREATE TABLE public.tbl_sexo (
    id_sexo integer NOT NULL,
    nom_sexo character varying NOT NULL
);
    DROP TABLE public.tbl_sexo;
       public         heap    postgres    false            �            1259    17383    tbl_sexo_id_sexo_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_sexo_id_sexo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.tbl_sexo_id_sexo_seq;
       public          postgres    false    253            �           0    0    tbl_sexo_id_sexo_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.tbl_sexo_id_sexo_seq OWNED BY public.tbl_sexo.id_sexo;
          public          postgres    false    254            �            1259    17384    tbl_usu    TABLE     �  CREATE TABLE public.tbl_usu (
    id_usu integer NOT NULL,
    usuario character varying(50) NOT NULL,
    nombre character varying(50) NOT NULL,
    apellido character varying(50) NOT NULL,
    correo character varying(50) NOT NULL,
    contrasena character varying(100) NOT NULL,
    telefono integer,
    num_colegiacion integer,
    num_empleaddo integer NOT NULL,
    estado character varying(15) NOT NULL,
    jornada integer NOT NULL,
    puesto integer NOT NULL,
    sede integer NOT NULL
);
    DROP TABLE public.tbl_usu;
       public         heap    postgres    false                        1259    17387    tbl_usu_id_usu_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_usu_id_usu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tbl_usu_id_usu_seq;
       public          postgres    false    255            �           0    0    tbl_usu_id_usu_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tbl_usu_id_usu_seq OWNED BY public.tbl_usu.id_usu;
          public          postgres    false    256            �           2604    17388    tbl_agresor id_agresor    DEFAULT     �   ALTER TABLE ONLY public.tbl_agresor ALTER COLUMN id_agresor SET DEFAULT nextval('public.tbl_agresor_id_agresor_seq'::regclass);
 E   ALTER TABLE public.tbl_agresor ALTER COLUMN id_agresor DROP DEFAULT;
       public          postgres    false    216    215            �           2604    17389     tbl_departamento id_departamento    DEFAULT     �   ALTER TABLE ONLY public.tbl_departamento ALTER COLUMN id_departamento SET DEFAULT nextval('public.tbl_departamento_id_departamento_seq'::regclass);
 O   ALTER TABLE public.tbl_departamento ALTER COLUMN id_departamento DROP DEFAULT;
       public          postgres    false    219    218            �           2604    17390    tbl_dependencia id_dependencia    DEFAULT     �   ALTER TABLE ONLY public.tbl_dependencia ALTER COLUMN id_dependencia SET DEFAULT nextval('public.tbl_dependencia_id_dependencia_seq'::regclass);
 M   ALTER TABLE public.tbl_dependencia ALTER COLUMN id_dependencia DROP DEFAULT;
       public          postgres    false    221    220            �           2604    17391    tbl_escolaridad id_escolaridad    DEFAULT     �   ALTER TABLE ONLY public.tbl_escolaridad ALTER COLUMN id_escolaridad SET DEFAULT nextval('public.tbl_escolaridad_id_escolaridad_seq'::regclass);
 M   ALTER TABLE public.tbl_escolaridad ALTER COLUMN id_escolaridad DROP DEFAULT;
       public          postgres    false    224    223            �           2604    17392     tbl_estado_civil id_estado_civil    DEFAULT     �   ALTER TABLE ONLY public.tbl_estado_civil ALTER COLUMN id_estado_civil SET DEFAULT nextval('public.tbl_estado_civil_id_estado_civil_seq'::regclass);
 O   ALTER TABLE public.tbl_estado_civil ALTER COLUMN id_estado_civil DROP DEFAULT;
       public          postgres    false    226    225            �           2604    17393    tbl_estados id_estado    DEFAULT     ~   ALTER TABLE ONLY public.tbl_estados ALTER COLUMN id_estado SET DEFAULT nextval('public.tbl_estados_id_estado_seq'::regclass);
 D   ALTER TABLE public.tbl_estados ALTER COLUMN id_estado DROP DEFAULT;
       public          postgres    false    228    227            �           2604    17394    tbl_evaluado id_evaluado    DEFAULT     �   ALTER TABLE ONLY public.tbl_evaluado ALTER COLUMN id_evaluado SET DEFAULT nextval('public.tbl_evaluado_id_evaluado_seq'::regclass);
 G   ALTER TABLE public.tbl_evaluado ALTER COLUMN id_evaluado DROP DEFAULT;
       public          postgres    false    231    230            �           2604    17395    tbl_instrumento id_instrumento    DEFAULT     �   ALTER TABLE ONLY public.tbl_instrumento ALTER COLUMN id_instrumento SET DEFAULT nextval('public.tbl_instrumento_id_instrumento_seq'::regclass);
 M   ALTER TABLE public.tbl_instrumento ALTER COLUMN id_instrumento DROP DEFAULT;
       public          postgres    false    234    233            �           2604    17396    tbl_jornada id_jornada    DEFAULT     �   ALTER TABLE ONLY public.tbl_jornada ALTER COLUMN id_jornada SET DEFAULT nextval('public.tbl_jornada_id_jornada_seq'::regclass);
 E   ALTER TABLE public.tbl_jornada ALTER COLUMN id_jornada DROP DEFAULT;
       public          postgres    false    236    235            �           2604    17397    tbl_municipio id_municipio    DEFAULT     �   ALTER TABLE ONLY public.tbl_municipio ALTER COLUMN id_municipio SET DEFAULT nextval('public.tbl_municipio_id_municipio_seq'::regclass);
 I   ALTER TABLE public.tbl_municipio ALTER COLUMN id_municipio DROP DEFAULT;
       public          postgres    false    238    237            �           2604    17398     tbl_nacionalidad id_nacionalidad    DEFAULT     �   ALTER TABLE ONLY public.tbl_nacionalidad ALTER COLUMN id_nacionalidad SET DEFAULT nextval('public.tbl_nacionalidad_id_nacionalidad_seq'::regclass);
 O   ALTER TABLE public.tbl_nacionalidad ALTER COLUMN id_nacionalidad DROP DEFAULT;
       public          postgres    false    240    239            �           2604    17399    tbl_ocupaciones id_ocupacion    DEFAULT     �   ALTER TABLE ONLY public.tbl_ocupaciones ALTER COLUMN id_ocupacion SET DEFAULT nextval('public.tbl_ocupaciones_id_ocupacion_seq'::regclass);
 K   ALTER TABLE public.tbl_ocupaciones ALTER COLUMN id_ocupacion DROP DEFAULT;
       public          postgres    false    242    241            �           2604    17400    tbl_proveidos id_proveidos    DEFAULT     �   ALTER TABLE ONLY public.tbl_proveidos ALTER COLUMN id_proveidos SET DEFAULT nextval('public.tbl_proveidos_id_proveidos_seq'::regclass);
 I   ALTER TABLE public.tbl_proveidos ALTER COLUMN id_proveidos DROP DEFAULT;
       public          postgres    false    244    243            �           2604    17401    tbl_puestos id_puesto    DEFAULT     ~   ALTER TABLE ONLY public.tbl_puestos ALTER COLUMN id_puesto SET DEFAULT nextval('public.tbl_puestos_id_puesto_seq'::regclass);
 D   ALTER TABLE public.tbl_puestos ALTER COLUMN id_puesto DROP DEFAULT;
       public          postgres    false    246    245            �           2604    17402 $   tbl_reconocimiento id_reconocimiento    DEFAULT     �   ALTER TABLE ONLY public.tbl_reconocimiento ALTER COLUMN id_reconocimiento SET DEFAULT nextval('public.tbl_reconocimiento_id_reconocimiento_seq'::regclass);
 S   ALTER TABLE public.tbl_reconocimiento ALTER COLUMN id_reconocimiento DROP DEFAULT;
       public          postgres    false    248    247            �           2604    17403    tbl_roles id_rol    DEFAULT     t   ALTER TABLE ONLY public.tbl_roles ALTER COLUMN id_rol SET DEFAULT nextval('public.tbl_roles_id_rol_seq'::regclass);
 ?   ALTER TABLE public.tbl_roles ALTER COLUMN id_rol DROP DEFAULT;
       public          postgres    false    250    249            �           2604    17404    tbl_sedes id_sede    DEFAULT     v   ALTER TABLE ONLY public.tbl_sedes ALTER COLUMN id_sede SET DEFAULT nextval('public.tbl_sedes_id_sede_seq'::regclass);
 @   ALTER TABLE public.tbl_sedes ALTER COLUMN id_sede DROP DEFAULT;
       public          postgres    false    252    251            �           2604    17405    tbl_sexo id_sexo    DEFAULT     t   ALTER TABLE ONLY public.tbl_sexo ALTER COLUMN id_sexo SET DEFAULT nextval('public.tbl_sexo_id_sexo_seq'::regclass);
 ?   ALTER TABLE public.tbl_sexo ALTER COLUMN id_sexo DROP DEFAULT;
       public          postgres    false    254    253            �           2604    17406    tbl_usu id_usu    DEFAULT     p   ALTER TABLE ONLY public.tbl_usu ALTER COLUMN id_usu SET DEFAULT nextval('public.tbl_usu_id_usu_seq'::regclass);
 =   ALTER TABLE public.tbl_usu ALTER COLUMN id_usu DROP DEFAULT;
       public          postgres    false    256    255            N          0    17292    tbl_agresor 
   TABLE DATA           >   COPY public.tbl_agresor (id_agresor, nom_agresor) FROM stdin;
    public          postgres    false    215   8�       P          0    17296    tbl_citaciones 
   TABLE DATA           �   COPY public.tbl_citaciones (numero_caso, tipo_citacion, fecha_recep_citacion, fecha_citacion, medico, lugar_citacion) FROM stdin;
    public          postgres    false    217   U�       Q          0    17299    tbl_departamento 
   TABLE DATA           P   COPY public.tbl_departamento (id_departamento, nombre_departamento) FROM stdin;
    public          postgres    false    218   r�       S          0    17303    tbl_dependencia 
   TABLE DATA           J   COPY public.tbl_dependencia (id_dependencia, nom_dependencia) FROM stdin;
    public          postgres    false    220   <�       U          0    17307    tbl_dictamenes 
   TABLE DATA           �   COPY public.tbl_dictamenes (numero_caso, medico, fecha_evaluacion, autoridad_solicitante, tipo_documento, fecha_entrega, datos_extra) FROM stdin;
    public          postgres    false    222   ��       V          0    17310    tbl_escolaridad 
   TABLE DATA           J   COPY public.tbl_escolaridad (id_escolaridad, nom_escolaridad) FROM stdin;
    public          postgres    false    223   ޷       X          0    17314    tbl_estado_civil 
   TABLE DATA           E   COPY public.tbl_estado_civil (id_estado_civil, nom_sexo) FROM stdin;
    public          postgres    false    225   ��       Z          0    17320    tbl_estados 
   TABLE DATA           <   COPY public.tbl_estados (id_estado, nom_estado) FROM stdin;
    public          postgres    false    227   �       \          0    17326    tbl_evaluacion 
   TABLE DATA           �   COPY public.tbl_evaluacion (consentimiento_informado, instrumento_agresion, descripcion_evaluacion, relacion_agresor, especificar_relacion, sede_evaluacion, fecha_finalizacion, id_proveido) FROM stdin;
    public          postgres    false    229   5�       ]          0    17329    tbl_evaluado 
   TABLE DATA           �   COPY public.tbl_evaluado (id_evaluado, nombre_evaluado, apellido_evaluado, dni_evaluado, telefono_evaluado, id_sexo, edad, diversidad, tiempo, nombre_acompanante, apellido_acompanante, relacion_acompanante, id_proveido) FROM stdin;
    public          postgres    false    230   R�       _          0    17333 	   tbl_hecho 
   TABLE DATA           t   COPY public.tbl_hecho (id_departamento, id_municipio, localidad, lugar_hecho, fecha_hecho, id_proveido) FROM stdin;
    public          postgres    false    232   o�       `          0    17336    tbl_instrumento 
   TABLE DATA           I   COPY public.tbl_instrumento (id_instrumento, nom_intrumento) FROM stdin;
    public          postgres    false    233   ��       b          0    17340    tbl_jornada 
   TABLE DATA           >   COPY public.tbl_jornada (id_jornada, nom_jornada) FROM stdin;
    public          postgres    false    235   ��       d          0    17346    tbl_municipio 
   TABLE DATA           X   COPY public.tbl_municipio (id_municipio, nombre_municipio, id_departamento) FROM stdin;
    public          postgres    false    237   Ѹ       f          0    17350    tbl_nacionalidad 
   TABLE DATA           M   COPY public.tbl_nacionalidad (id_nacionalidad, nom_nacionalidad) FROM stdin;
    public          postgres    false    239   �       h          0    17354    tbl_ocupaciones 
   TABLE DATA           F   COPY public.tbl_ocupaciones (id_ocupacion, nom_ocupacion) FROM stdin;
    public          postgres    false    241   +�       j          0    17358    tbl_proveidos 
   TABLE DATA           �   COPY public.tbl_proveidos (id_proveidos, num_caso, num_caso_ext, fech_emi_soli, fech_recep_soli, fiscalia_remitente) FROM stdin;
    public          postgres    false    243   H�       l          0    17362    tbl_puestos 
   TABLE DATA           D   COPY public.tbl_puestos (id_puesto, nom_puesto, estado) FROM stdin;
    public          postgres    false    245   ��       n          0    17366    tbl_reconocimiento 
   TABLE DATA           S   COPY public.tbl_reconocimiento (id_reconocimiento, nom_reconocimiento) FROM stdin;
    public          postgres    false    247   ��       p          0    17370 	   tbl_roles 
   TABLE DATA           4   COPY public.tbl_roles (id_rol, nom_rol) FROM stdin;
    public          postgres    false    249   >�       r          0    17374 	   tbl_sedes 
   TABLE DATA           V   COPY public.tbl_sedes (id_sede, fk_departamento, fk_municipio, ubucacion) FROM stdin;
    public          postgres    false    251   [�       t          0    17378    tbl_sexo 
   TABLE DATA           5   COPY public.tbl_sexo (id_sexo, nom_sexo) FROM stdin;
    public          postgres    false    253   ��       v          0    17384    tbl_usu 
   TABLE DATA           �   COPY public.tbl_usu (id_usu, usuario, nombre, apellido, correo, contrasena, telefono, num_colegiacion, num_empleaddo, estado, jornada, puesto, sede) FROM stdin;
    public          postgres    false    255   ��       �           0    0    tbl_agresor_id_agresor_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.tbl_agresor_id_agresor_seq', 1, false);
          public          postgres    false    216            �           0    0 $   tbl_departamento_id_departamento_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.tbl_departamento_id_departamento_seq', 18, true);
          public          postgres    false    219            �           0    0 "   tbl_dependencia_id_dependencia_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.tbl_dependencia_id_dependencia_seq', 5, true);
          public          postgres    false    221            �           0    0 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.tbl_escolaridad_id_escolaridad_seq', 1, false);
          public          postgres    false    224            �           0    0 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.tbl_estado_civil_id_estado_civil_seq', 1, false);
          public          postgres    false    226            �           0    0    tbl_estados_id_estado_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tbl_estados_id_estado_seq', 1, false);
          public          postgres    false    228            �           0    0    tbl_evaluado_id_evaluado_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.tbl_evaluado_id_evaluado_seq', 1, false);
          public          postgres    false    231            �           0    0 "   tbl_instrumento_id_instrumento_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.tbl_instrumento_id_instrumento_seq', 1, false);
          public          postgres    false    234            �           0    0    tbl_jornada_id_jornada_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tbl_jornada_id_jornada_seq', 1, true);
          public          postgres    false    236            �           0    0    tbl_municipio_id_municipio_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tbl_municipio_id_municipio_seq', 1136, true);
          public          postgres    false    238            �           0    0 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.tbl_nacionalidad_id_nacionalidad_seq', 1, false);
          public          postgres    false    240            �           0    0     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tbl_ocupaciones_id_ocupacion_seq', 1, false);
          public          postgres    false    242            �           0    0    tbl_proveidos_id_proveidos_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.tbl_proveidos_id_proveidos_seq', 7, true);
          public          postgres    false    244            �           0    0    tbl_puestos_id_puesto_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.tbl_puestos_id_puesto_seq', 1, true);
          public          postgres    false    246            �           0    0 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE SET     V   SELECT pg_catalog.setval('public.tbl_reconocimiento_id_reconocimiento_seq', 4, true);
          public          postgres    false    248            �           0    0    tbl_roles_id_rol_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tbl_roles_id_rol_seq', 1, false);
          public          postgres    false    250            �           0    0    tbl_sedes_id_sede_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tbl_sedes_id_sede_seq', 2, true);
          public          postgres    false    252            �           0    0    tbl_sexo_id_sexo_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.tbl_sexo_id_sexo_seq', 7, true);
          public          postgres    false    254            �           0    0    tbl_usu_id_usu_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.tbl_usu_id_usu_seq', 2, true);
          public          postgres    false    256            �           2606    17408    tbl_estados estados_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tbl_estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id_estado);
 B   ALTER TABLE ONLY public.tbl_estados DROP CONSTRAINT estados_pkey;
       public            postgres    false    227            �           2606    17410    tbl_agresor tbl_agresor_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tbl_agresor
    ADD CONSTRAINT tbl_agresor_pkey PRIMARY KEY (id_agresor);
 F   ALTER TABLE ONLY public.tbl_agresor DROP CONSTRAINT tbl_agresor_pkey;
       public            postgres    false    215            �           2606    17412 &   tbl_departamento tbl_departamento_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_departamento
    ADD CONSTRAINT tbl_departamento_pkey PRIMARY KEY (id_departamento);
 P   ALTER TABLE ONLY public.tbl_departamento DROP CONSTRAINT tbl_departamento_pkey;
       public            postgres    false    218            �           2606    17414 $   tbl_dependencia tbl_dependencia_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_dependencia
    ADD CONSTRAINT tbl_dependencia_pkey PRIMARY KEY (id_dependencia);
 N   ALTER TABLE ONLY public.tbl_dependencia DROP CONSTRAINT tbl_dependencia_pkey;
       public            postgres    false    220            �           2606    17416 $   tbl_escolaridad tbl_escolaridad_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_escolaridad
    ADD CONSTRAINT tbl_escolaridad_pkey PRIMARY KEY (id_escolaridad);
 N   ALTER TABLE ONLY public.tbl_escolaridad DROP CONSTRAINT tbl_escolaridad_pkey;
       public            postgres    false    223            �           2606    17418 &   tbl_estado_civil tbl_estado_civil_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_estado_civil
    ADD CONSTRAINT tbl_estado_civil_pkey PRIMARY KEY (id_estado_civil);
 P   ALTER TABLE ONLY public.tbl_estado_civil DROP CONSTRAINT tbl_estado_civil_pkey;
       public            postgres    false    225            �           2606    17420    tbl_evaluado tbl_evaluado_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT tbl_evaluado_pkey PRIMARY KEY (id_evaluado);
 H   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT tbl_evaluado_pkey;
       public            postgres    false    230            �           2606    17422 $   tbl_instrumento tbl_instrumento_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_instrumento
    ADD CONSTRAINT tbl_instrumento_pkey PRIMARY KEY (id_instrumento);
 N   ALTER TABLE ONLY public.tbl_instrumento DROP CONSTRAINT tbl_instrumento_pkey;
       public            postgres    false    233            �           2606    17424    tbl_jornada tbl_jornada_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tbl_jornada
    ADD CONSTRAINT tbl_jornada_pkey PRIMARY KEY (id_jornada);
 F   ALTER TABLE ONLY public.tbl_jornada DROP CONSTRAINT tbl_jornada_pkey;
       public            postgres    false    235            �           2606    17426     tbl_municipio tbl_municipio_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tbl_municipio
    ADD CONSTRAINT tbl_municipio_pkey PRIMARY KEY (id_municipio);
 J   ALTER TABLE ONLY public.tbl_municipio DROP CONSTRAINT tbl_municipio_pkey;
       public            postgres    false    237            �           2606    17428 &   tbl_nacionalidad tbl_nacionalidad_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_nacionalidad
    ADD CONSTRAINT tbl_nacionalidad_pkey PRIMARY KEY (id_nacionalidad);
 P   ALTER TABLE ONLY public.tbl_nacionalidad DROP CONSTRAINT tbl_nacionalidad_pkey;
       public            postgres    false    239            �           2606    17430 $   tbl_ocupaciones tbl_ocupaciones_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.tbl_ocupaciones
    ADD CONSTRAINT tbl_ocupaciones_pkey PRIMARY KEY (id_ocupacion);
 N   ALTER TABLE ONLY public.tbl_ocupaciones DROP CONSTRAINT tbl_ocupaciones_pkey;
       public            postgres    false    241            �           2606    17432     tbl_proveidos tbl_proveidos_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tbl_proveidos
    ADD CONSTRAINT tbl_proveidos_pkey PRIMARY KEY (id_proveidos);
 J   ALTER TABLE ONLY public.tbl_proveidos DROP CONSTRAINT tbl_proveidos_pkey;
       public            postgres    false    243            �           2606    17434    tbl_puestos tbl_puestos_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.tbl_puestos
    ADD CONSTRAINT tbl_puestos_pkey PRIMARY KEY (id_puesto);
 F   ALTER TABLE ONLY public.tbl_puestos DROP CONSTRAINT tbl_puestos_pkey;
       public            postgres    false    245            �           2606    17436 *   tbl_reconocimiento tbl_reconocimiento_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY public.tbl_reconocimiento
    ADD CONSTRAINT tbl_reconocimiento_pkey PRIMARY KEY (id_reconocimiento);
 T   ALTER TABLE ONLY public.tbl_reconocimiento DROP CONSTRAINT tbl_reconocimiento_pkey;
       public            postgres    false    247            �           2606    17438    tbl_sedes tbl_sedes_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.tbl_sedes
    ADD CONSTRAINT tbl_sedes_pkey PRIMARY KEY (id_sede);
 B   ALTER TABLE ONLY public.tbl_sedes DROP CONSTRAINT tbl_sedes_pkey;
       public            postgres    false    251            �           2606    17440    tbl_sexo tbl_sexo_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.tbl_sexo
    ADD CONSTRAINT tbl_sexo_pkey PRIMARY KEY (id_sexo);
 @   ALTER TABLE ONLY public.tbl_sexo DROP CONSTRAINT tbl_sexo_pkey;
       public            postgres    false    253            �           2606    17442    tbl_usu tbl_usu_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.tbl_usu
    ADD CONSTRAINT tbl_usu_pkey PRIMARY KEY (id_usu);
 >   ALTER TABLE ONLY public.tbl_usu DROP CONSTRAINT tbl_usu_pkey;
       public            postgres    false    255            �           2606    17443    tbl_municipio fk_departamento    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_municipio
    ADD CONSTRAINT fk_departamento FOREIGN KEY (id_departamento) REFERENCES public.tbl_departamento(id_departamento);
 G   ALTER TABLE ONLY public.tbl_municipio DROP CONSTRAINT fk_departamento;
       public          postgres    false    237    4762    218            �           2606    17448    tbl_evaluado fk_proveido    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT fk_proveido FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 B   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT fk_proveido;
       public          postgres    false    243    230    4784            �           2606    17453 %   tbl_evaluacion fk_proveido_evaluacion    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluacion
    ADD CONSTRAINT fk_proveido_evaluacion FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 O   ALTER TABLE ONLY public.tbl_evaluacion DROP CONSTRAINT fk_proveido_evaluacion;
       public          postgres    false    4784    229    243            �           2606    17458    tbl_hecho fk_proveido_hechos    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_hecho
    ADD CONSTRAINT fk_proveido_hechos FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 F   ALTER TABLE ONLY public.tbl_hecho DROP CONSTRAINT fk_proveido_hechos;
       public          postgres    false    232    4784    243            N      x������ � �      P      x������ � �      Q   �   x���
1���S�	����EA/�����Y��A��x�0�/K�є� h%Q������tn��X5�yB�ZbW�Oi�	!�h�и����$|���.�d����i�ϪNiki����D�%��Л_�C:�W��#:9)���γ�I+�Z�N���p��ON�54��$�{���kD�      S   u   x�3�t��stq��2��\ø�9��JR�K�RsRR�J�K2�34���4�L8���L9C�2SS@
|KS�Z��2�sR�J�����K�4B}�<�5�b���� ��!�      U      x������ � �      V      x������ � �      X      x������ � �      Z      x������ � �      \      x������ � �      ]      x������ � �      _      x������ � �      `      x������ � �      b      x�3�t��-�I-I����� '�"      d   -	  x�uXYr#���N�8Xk��ԭ�ڬ����@E4E��A&�:�\a�0��_fER���{�{�)Zu�ƾh��5�R}���n����q��$�\]��꽠�>�գ����^�;��J=�^ĕZ{��A�z�����S9`��u�MO�Q����� ����;7��G���i�^\�'�"�G7��'�Xo��op-l��ˇ�����Թ����|�3[�����Vp��oa2��-�N�-�����`��(S��?�r�ҍ}1P���N�AI�'o��╺1o���5z��=�Z��A���{/g7��͍��L�l�k�����B���ʓ��ٱ�`�F6�Yˋ�`�e5ky�ż�~00�Z�4�����W��e;���0�"�a�����&���:��E>l>X������N��������Y�FCg������=RS9(�ȂB]�.ȫ	���7�v�>��3�;�{񆩊�A{mG�D�.�Ũ!�]۴�үC�N�Tw���k���%��V��d��7釘��tD��y�½��N6��������m�̃�x�gV���V%ǋ��t�v�T��·w��a���J�@B��P�NP��wN~����8����E��L���9g2���z��̲�4����{������!���ly�۟,�2qʁ��D�LyBV����fp��{�ٞ���Ց��η�~�T��^C�&����ad������1�*|ٹ���|�n�w��c�L�!�G�o��
qޑO3,ԃ�V��ˏj��&����h��DT7"XG��*�h���$��z��F� ��*�11���-�j�뀫��'=���ǱCD�~�#��0*յ�to��Fγ�@�]�B:w�I{Qs�NĴ�G��˘�:-8�o�l$�7�y	(Va�G8/����d��ɍ!Қ�8�ս�PҾjX^�%ͽţ�Ɏ���r��<JK�������]PX�����E�I-&�T��P7���"�C� R���T��������Q/�v�W;�P�PYި�`+g��=<-���2j,�b��U?x�X�k�3h�n£���;�L}��aI 9ᖢ��=�knK�N� ����=i$���h
��^`��=Wǿ�X[��Y�o'���ߐp%_u��1g��C�jՂ�չT��a-�k���V����BԹG��gAw��.���L�S�g��[&8��aC���g-�!�QB�",:v�8�1w�ل���ȰVW���6iԵ�t!�UXJl�n7�2�@t�t��DvR�ʏ�3�lt��D���6\}�&��3U#Pw�������I]���?�#Q����Y�DQD��["�7Lt���X�'i�~�쌸S~��*�	��Pw��L�)��[�^W�C�)}E�hS&��>��9��	'{fK�6:}�*xk|g6f<�J��� _��]V|�ݑ�W�%B���Du�8ధ0�>-���U�Tv>�1�bZj-s�ĵ�[��!��٦�|~�>�0W����l��u��"*I��'�9S+q&�RV�2S����"b"Ö�V�T�Ќ�$�+ؼOL�mp�hB�R��g맰�L���+w�E�|@�9,H}��p���l{ȴ'o�%T,�^�������|	��M�5e�*)sb��Ls*XaF���Be�,���ۨ
�Whfk�d����&.��֟�(���K#JV��/,ؚ(���'���"%�B��YP*��&��p\�?#�z.cii��Z�8�Z!=�Sq3�e$�=��G
Y-�Y��P��I�o��%R��i"����H�C�9�q�s?�1+bj���^��.S�	���hc�e]:O�3���S�)�;���X-T.�59�x��X��?-.%�q�Ȭ���}���}�.tH7G���3ԋ��q}C�t~oC���Q��q���-���sn:)_���qA�,_�?~��A')B�W�wi+�8ץˣB?����)��k��ո����z�P��C�r�~�]�3�F� `���?�<w��ì4����G��H��|%���,54.R�ؼ�%�y�J����F/��"�c��z߸;`������y"���L.탩�#]t�LU����3�O�7��I���!ړX$J��yj�x���-�e�//��{��q�4P<9|X\�~$V\w��v>�����ˣ>��h���j�hX{+]%c2;�g;�ٗvh���`��^�f�Z�Ї:���7Р+�'��9Z�bi/n���.s��]iԸ^�G(�c��M��o�n��#��|-q�(��S���ab�^�=���L��A�C���Ce��ow����������;      f      x������ � �      h      x������ � �      j   Y   x���A� ��_l\�����G�ML�ՙ �EQ����[��J6�굘�M�6�Z��_��9mн��ρ_owk�Eq ��(�      l      x�3��MM�L��tL.�,������ Db�      n   P   x�3�t-.IL�WHIUN�)M�2�tI��,�WN�(M��2��I-���K-�2�t�(HM�L�+IUp�9�0/39�+F��� N�<      p      x������ � �      r   3   x�3��4��IM/M�LO�)H�2�4�40�N�S�,I-����� �m
�      t   )   x�3���/�M��2��ML���2�LLK)N+NI����� �s	U      v   �   x�3�LK-J��/J-�tK-�K�K��t���2鹉�9z����*F�*�*9�i�F.��~���fy�i>�e�~�~�N�&)�aeN!&%�)�z9)�i>Υ��F�&�f���@�\�Y�fr�.��~(dr~QQj�����[��W� O�J�     