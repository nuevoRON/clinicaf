PGDMP  7    .                |            clinica    16.3    16.3 �    {           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            |           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            }           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            ~           1262    17094    clinica    DATABASE     }   CREATE DATABASE clinica WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Honduras.1252';
    DROP DATABASE clinica;
                postgres    false            �            1259    17096    tbl_agresor    TABLE     u   CREATE TABLE public.tbl_agresor (
    id_agresor integer NOT NULL,
    nom_agresor character varying(50) NOT NULL
);
    DROP TABLE public.tbl_agresor;
       public         heap    postgres    false                       0    0    TABLE tbl_agresor    COMMENT     o   COMMENT ON TABLE public.tbl_agresor IS 'en esta tabla se agregaran los agresores utilizados en la aplicacion';
          public          postgres    false    216            �            1259    17095    tbl_agresor_id_agresor_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_agresor_id_agresor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tbl_agresor_id_agresor_seq;
       public          postgres    false    216            �           0    0    tbl_agresor_id_agresor_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tbl_agresor_id_agresor_seq OWNED BY public.tbl_agresor.id_agresor;
          public          postgres    false    215            �            1259    17100    tbl_citaciones    TABLE       CREATE TABLE public.tbl_citaciones (
    numero_caso character varying(10) NOT NULL,
    tipo_citacion character varying(15) NOT NULL,
    fecha_recep_citacion date NOT NULL,
    fecha_citacion date NOT NULL,
    medico integer NOT NULL,
    lugar_citacion character varying(255)
);
 "   DROP TABLE public.tbl_citaciones;
       public         heap    postgres    false            �            1259    17104    tbl_departamento    TABLE     ~   CREATE TABLE public.tbl_departamento (
    id_departamento integer NOT NULL,
    nombre_departamento character varying(50)
);
 $   DROP TABLE public.tbl_departamento;
       public         heap    postgres    false            �            1259    17103 $   tbl_departamento_id_departamento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_departamento_id_departamento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_departamento_id_departamento_seq;
       public          postgres    false    219            �           0    0 $   tbl_departamento_id_departamento_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_departamento_id_departamento_seq OWNED BY public.tbl_departamento.id_departamento;
          public          postgres    false    218            �            1259    17109    tbl_dependencia    TABLE     �   CREATE TABLE public.tbl_dependencia (
    id_dependencia integer NOT NULL,
    nom_dependencia character varying(80) NOT NULL
);
 #   DROP TABLE public.tbl_dependencia;
       public         heap    postgres    false            �           0    0    TABLE tbl_dependencia    COMMENT     ~   COMMENT ON TABLE public.tbl_dependencia IS 'en esta tabla se agregaran las dependencias que solicitan analisis a la clinica';
          public          postgres    false    221            �            1259    17108 "   tbl_dependencia_id_dependencia_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_dependencia_id_dependencia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_dependencia_id_dependencia_seq;
       public          postgres    false    221            �           0    0 "   tbl_dependencia_id_dependencia_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_dependencia_id_dependencia_seq OWNED BY public.tbl_dependencia.id_dependencia;
          public          postgres    false    220            �            1259    17113    tbl_dictamenes    TABLE     F  CREATE TABLE public.tbl_dictamenes (
    numero_caso character varying(10) NOT NULL,
    medico integer NOT NULL,
    fecha_evaluacion date,
    autoridad_solicitante character varying(100) NOT NULL,
    tipo_documento character varying(15) NOT NULL,
    fecha_entrega date NOT NULL,
    datos_extra character varying(255)
);
 "   DROP TABLE public.tbl_dictamenes;
       public         heap    postgres    false            �            1259    17117    tbl_escolaridad    TABLE     �   CREATE TABLE public.tbl_escolaridad (
    id_escolaridad integer NOT NULL,
    nom_escolaridad character varying(30) NOT NULL
);
 #   DROP TABLE public.tbl_escolaridad;
       public         heap    postgres    false            �            1259    17116 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_escolaridad_id_escolaridad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_escolaridad_id_escolaridad_seq;
       public          postgres    false    224            �           0    0 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_escolaridad_id_escolaridad_seq OWNED BY public.tbl_escolaridad.id_escolaridad;
          public          postgres    false    223            �            1259    17122    tbl_estado_civil    TABLE     x   CREATE TABLE public.tbl_estado_civil (
    id_estado_civil integer NOT NULL,
    nom_sexo character varying NOT NULL
);
 $   DROP TABLE public.tbl_estado_civil;
       public         heap    postgres    false            �            1259    17121 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_estado_civil_id_estado_civil_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_estado_civil_id_estado_civil_seq;
       public          postgres    false    226            �           0    0 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_estado_civil_id_estado_civil_seq OWNED BY public.tbl_estado_civil.id_estado_civil;
          public          postgres    false    225            �            1259    17129    tbl_estados    TABLE     o   CREATE TABLE public.tbl_estados (
    id_estado integer NOT NULL,
    nom_estado character varying NOT NULL
);
    DROP TABLE public.tbl_estados;
       public         heap    postgres    false            �            1259    17128    tbl_estados_id_estado_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_estados_id_estado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tbl_estados_id_estado_seq;
       public          postgres    false    228            �           0    0    tbl_estados_id_estado_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tbl_estados_id_estado_seq OWNED BY public.tbl_estados.id_estado;
          public          postgres    false    227            �            1259    17135    tbl_evaluacion    TABLE     q  CREATE TABLE public.tbl_evaluacion (
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
       public         heap    postgres    false            �            1259    17139    tbl_evaluado    TABLE     m  CREATE TABLE public.tbl_evaluado (
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
       public         heap    postgres    false            �            1259    17138    tbl_evaluado_id_evaluado_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_evaluado_id_evaluado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.tbl_evaluado_id_evaluado_seq;
       public          postgres    false    231            �           0    0    tbl_evaluado_id_evaluado_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.tbl_evaluado_id_evaluado_seq OWNED BY public.tbl_evaluado.id_evaluado;
          public          postgres    false    230            �            1259    17143 	   tbl_hecho    TABLE     �   CREATE TABLE public.tbl_hecho (
    id_departamento integer,
    id_municipio integer,
    localidad character varying(100),
    lugar_hecho character varying(30),
    fecha_hecho date,
    id_proveido integer NOT NULL
);
    DROP TABLE public.tbl_hecho;
       public         heap    postgres    false            �            1259    17147    tbl_instrumento    TABLE     �   CREATE TABLE public.tbl_instrumento (
    id_instrumento integer NOT NULL,
    nom_intrumento character varying(50) NOT NULL
);
 #   DROP TABLE public.tbl_instrumento;
       public         heap    postgres    false            �            1259    17146 "   tbl_instrumento_id_instrumento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_instrumento_id_instrumento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_instrumento_id_instrumento_seq;
       public          postgres    false    234            �           0    0 "   tbl_instrumento_id_instrumento_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_instrumento_id_instrumento_seq OWNED BY public.tbl_instrumento.id_instrumento;
          public          postgres    false    233            �            1259    17152    tbl_jornada    TABLE     h   CREATE TABLE public.tbl_jornada (
    id_jornada integer NOT NULL,
    nom_jornada character varying
);
    DROP TABLE public.tbl_jornada;
       public         heap    postgres    false            �            1259    17151    tbl_jornada_id_jornada_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_jornada_id_jornada_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tbl_jornada_id_jornada_seq;
       public          postgres    false    236            �           0    0    tbl_jornada_id_jornada_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tbl_jornada_id_jornada_seq OWNED BY public.tbl_jornada.id_jornada;
          public          postgres    false    235            �            1259    17159    tbl_municipio    TABLE     �   CREATE TABLE public.tbl_municipio (
    id_municipio integer NOT NULL,
    nombre_municipio character varying(100),
    id_departamento integer NOT NULL
);
 !   DROP TABLE public.tbl_municipio;
       public         heap    postgres    false            �            1259    17158    tbl_municipio_id_municipio_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_municipio_id_municipio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tbl_municipio_id_municipio_seq;
       public          postgres    false    238            �           0    0    tbl_municipio_id_municipio_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tbl_municipio_id_municipio_seq OWNED BY public.tbl_municipio.id_municipio;
          public          postgres    false    237            �            1259    17164    tbl_nacionalidad    TABLE     �   CREATE TABLE public.tbl_nacionalidad (
    id_nacionalidad integer NOT NULL,
    nom_nacionalidad character varying(30) NOT NULL
);
 $   DROP TABLE public.tbl_nacionalidad;
       public         heap    postgres    false            �            1259    17163 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq;
       public          postgres    false    240            �           0    0 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq OWNED BY public.tbl_nacionalidad.id_nacionalidad;
          public          postgres    false    239            �            1259    17169    tbl_ocupaciones    TABLE     }   CREATE TABLE public.tbl_ocupaciones (
    id_ocupacion integer NOT NULL,
    nom_ocupacion character varying(20) NOT NULL
);
 #   DROP TABLE public.tbl_ocupaciones;
       public         heap    postgres    false            �            1259    17168     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq;
       public          postgres    false    242            �           0    0     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq OWNED BY public.tbl_ocupaciones.id_ocupacion;
          public          postgres    false    241            �            1259    17174    tbl_proveidos    TABLE     �   CREATE TABLE public.tbl_proveidos (
    id_proveidos integer NOT NULL,
    num_caso integer NOT NULL,
    num_caso_ext integer,
    fech_emi_soli date NOT NULL,
    fech_recep_soli date NOT NULL
);
 !   DROP TABLE public.tbl_proveidos;
       public         heap    postgres    false            �            1259    17173    tbl_proveidos_id_proveidos_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_proveidos_id_proveidos_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tbl_proveidos_id_proveidos_seq;
       public          postgres    false    244            �           0    0    tbl_proveidos_id_proveidos_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tbl_proveidos_id_proveidos_seq OWNED BY public.tbl_proveidos.id_proveidos;
          public          postgres    false    243            �            1259    17179    tbl_puestos    TABLE     �   CREATE TABLE public.tbl_puestos (
    id_puesto integer NOT NULL,
    nom_puesto character varying(25) NOT NULL,
    estado character varying(25) NOT NULL,
    jornada character varying(20) NOT NULL
);
    DROP TABLE public.tbl_puestos;
       public         heap    postgres    false            �            1259    17178    tbl_puestos_id_puesto_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_puestos_id_puesto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tbl_puestos_id_puesto_seq;
       public          postgres    false    246            �           0    0    tbl_puestos_id_puesto_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tbl_puestos_id_puesto_seq OWNED BY public.tbl_puestos.id_puesto;
          public          postgres    false    245            �            1259    17184    tbl_reconocimiento    TABLE     �   CREATE TABLE public.tbl_reconocimiento (
    id_reconocimiento integer NOT NULL,
    nom_reconocimiento character varying(60) NOT NULL
);
 &   DROP TABLE public.tbl_reconocimiento;
       public         heap    postgres    false            �            1259    17183 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ?   DROP SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq;
       public          postgres    false    248            �           0    0 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE OWNED BY     u   ALTER SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq OWNED BY public.tbl_reconocimiento.id_reconocimiento;
          public          postgres    false    247            �            1259    17189 	   tbl_roles    TABLE     k   CREATE TABLE public.tbl_roles (
    id_rol integer NOT NULL,
    nom_rol character varying(20) NOT NULL
);
    DROP TABLE public.tbl_roles;
       public         heap    postgres    false            �            1259    17188    tbl_roles_id_rol_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_roles_id_rol_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.tbl_roles_id_rol_seq;
       public          postgres    false    250            �           0    0    tbl_roles_id_rol_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.tbl_roles_id_rol_seq OWNED BY public.tbl_roles.id_rol;
          public          postgres    false    249            �            1259    17195 	   tbl_sedes    TABLE     �   CREATE TABLE public.tbl_sedes (
    id_sede integer NOT NULL,
    fk_departamento integer NOT NULL,
    fk_municipio integer NOT NULL,
    ubucacion character varying(60) NOT NULL
);
    DROP TABLE public.tbl_sedes;
       public         heap    postgres    false            �            1259    17194    tbl_sedes_id_sede_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_sedes_id_sede_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tbl_sedes_id_sede_seq;
       public          postgres    false    252            �           0    0    tbl_sedes_id_sede_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tbl_sedes_id_sede_seq OWNED BY public.tbl_sedes.id_sede;
          public          postgres    false    251            �            1259    17200    tbl_sexo    TABLE     h   CREATE TABLE public.tbl_sexo (
    id_sexo integer NOT NULL,
    nom_sexo character varying NOT NULL
);
    DROP TABLE public.tbl_sexo;
       public         heap    postgres    false            �            1259    17199    tbl_sexo_id_sexo_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_sexo_id_sexo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.tbl_sexo_id_sexo_seq;
       public          postgres    false    254            �           0    0    tbl_sexo_id_sexo_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.tbl_sexo_id_sexo_seq OWNED BY public.tbl_sexo.id_sexo;
          public          postgres    false    253                        1259    17207    tbl_usu    TABLE       CREATE TABLE public.tbl_usu (
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
    jornada character varying(15) NOT NULL,
    puesto character varying(40) NOT NULL,
    sede character varying(50) NOT NULL
);
    DROP TABLE public.tbl_usu;
       public         heap    postgres    false            �            1259    17206    tbl_usu_id_usu_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_usu_id_usu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tbl_usu_id_usu_seq;
       public          postgres    false    256            �           0    0    tbl_usu_id_usu_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tbl_usu_id_usu_seq OWNED BY public.tbl_usu.id_usu;
          public          postgres    false    255            �           2604    17099    tbl_agresor id_agresor    DEFAULT     �   ALTER TABLE ONLY public.tbl_agresor ALTER COLUMN id_agresor SET DEFAULT nextval('public.tbl_agresor_id_agresor_seq'::regclass);
 E   ALTER TABLE public.tbl_agresor ALTER COLUMN id_agresor DROP DEFAULT;
       public          postgres    false    215    216    216            �           2604    17107     tbl_departamento id_departamento    DEFAULT     �   ALTER TABLE ONLY public.tbl_departamento ALTER COLUMN id_departamento SET DEFAULT nextval('public.tbl_departamento_id_departamento_seq'::regclass);
 O   ALTER TABLE public.tbl_departamento ALTER COLUMN id_departamento DROP DEFAULT;
       public          postgres    false    219    218    219            �           2604    17112    tbl_dependencia id_dependencia    DEFAULT     �   ALTER TABLE ONLY public.tbl_dependencia ALTER COLUMN id_dependencia SET DEFAULT nextval('public.tbl_dependencia_id_dependencia_seq'::regclass);
 M   ALTER TABLE public.tbl_dependencia ALTER COLUMN id_dependencia DROP DEFAULT;
       public          postgres    false    220    221    221            �           2604    17120    tbl_escolaridad id_escolaridad    DEFAULT     �   ALTER TABLE ONLY public.tbl_escolaridad ALTER COLUMN id_escolaridad SET DEFAULT nextval('public.tbl_escolaridad_id_escolaridad_seq'::regclass);
 M   ALTER TABLE public.tbl_escolaridad ALTER COLUMN id_escolaridad DROP DEFAULT;
       public          postgres    false    223    224    224            �           2604    17125     tbl_estado_civil id_estado_civil    DEFAULT     �   ALTER TABLE ONLY public.tbl_estado_civil ALTER COLUMN id_estado_civil SET DEFAULT nextval('public.tbl_estado_civil_id_estado_civil_seq'::regclass);
 O   ALTER TABLE public.tbl_estado_civil ALTER COLUMN id_estado_civil DROP DEFAULT;
       public          postgres    false    225    226    226            �           2604    17132    tbl_estados id_estado    DEFAULT     ~   ALTER TABLE ONLY public.tbl_estados ALTER COLUMN id_estado SET DEFAULT nextval('public.tbl_estados_id_estado_seq'::regclass);
 D   ALTER TABLE public.tbl_estados ALTER COLUMN id_estado DROP DEFAULT;
       public          postgres    false    228    227    228            �           2604    17142    tbl_evaluado id_evaluado    DEFAULT     �   ALTER TABLE ONLY public.tbl_evaluado ALTER COLUMN id_evaluado SET DEFAULT nextval('public.tbl_evaluado_id_evaluado_seq'::regclass);
 G   ALTER TABLE public.tbl_evaluado ALTER COLUMN id_evaluado DROP DEFAULT;
       public          postgres    false    230    231    231            �           2604    17150    tbl_instrumento id_instrumento    DEFAULT     �   ALTER TABLE ONLY public.tbl_instrumento ALTER COLUMN id_instrumento SET DEFAULT nextval('public.tbl_instrumento_id_instrumento_seq'::regclass);
 M   ALTER TABLE public.tbl_instrumento ALTER COLUMN id_instrumento DROP DEFAULT;
       public          postgres    false    234    233    234            �           2604    17155    tbl_jornada id_jornada    DEFAULT     �   ALTER TABLE ONLY public.tbl_jornada ALTER COLUMN id_jornada SET DEFAULT nextval('public.tbl_jornada_id_jornada_seq'::regclass);
 E   ALTER TABLE public.tbl_jornada ALTER COLUMN id_jornada DROP DEFAULT;
       public          postgres    false    235    236    236            �           2604    17162    tbl_municipio id_municipio    DEFAULT     �   ALTER TABLE ONLY public.tbl_municipio ALTER COLUMN id_municipio SET DEFAULT nextval('public.tbl_municipio_id_municipio_seq'::regclass);
 I   ALTER TABLE public.tbl_municipio ALTER COLUMN id_municipio DROP DEFAULT;
       public          postgres    false    238    237    238            �           2604    17167     tbl_nacionalidad id_nacionalidad    DEFAULT     �   ALTER TABLE ONLY public.tbl_nacionalidad ALTER COLUMN id_nacionalidad SET DEFAULT nextval('public.tbl_nacionalidad_id_nacionalidad_seq'::regclass);
 O   ALTER TABLE public.tbl_nacionalidad ALTER COLUMN id_nacionalidad DROP DEFAULT;
       public          postgres    false    240    239    240            �           2604    17172    tbl_ocupaciones id_ocupacion    DEFAULT     �   ALTER TABLE ONLY public.tbl_ocupaciones ALTER COLUMN id_ocupacion SET DEFAULT nextval('public.tbl_ocupaciones_id_ocupacion_seq'::regclass);
 K   ALTER TABLE public.tbl_ocupaciones ALTER COLUMN id_ocupacion DROP DEFAULT;
       public          postgres    false    242    241    242            �           2604    17177    tbl_proveidos id_proveidos    DEFAULT     �   ALTER TABLE ONLY public.tbl_proveidos ALTER COLUMN id_proveidos SET DEFAULT nextval('public.tbl_proveidos_id_proveidos_seq'::regclass);
 I   ALTER TABLE public.tbl_proveidos ALTER COLUMN id_proveidos DROP DEFAULT;
       public          postgres    false    243    244    244            �           2604    17182    tbl_puestos id_puesto    DEFAULT     ~   ALTER TABLE ONLY public.tbl_puestos ALTER COLUMN id_puesto SET DEFAULT nextval('public.tbl_puestos_id_puesto_seq'::regclass);
 D   ALTER TABLE public.tbl_puestos ALTER COLUMN id_puesto DROP DEFAULT;
       public          postgres    false    246    245    246            �           2604    17187 $   tbl_reconocimiento id_reconocimiento    DEFAULT     �   ALTER TABLE ONLY public.tbl_reconocimiento ALTER COLUMN id_reconocimiento SET DEFAULT nextval('public.tbl_reconocimiento_id_reconocimiento_seq'::regclass);
 S   ALTER TABLE public.tbl_reconocimiento ALTER COLUMN id_reconocimiento DROP DEFAULT;
       public          postgres    false    248    247    248            �           2604    17192    tbl_roles id_rol    DEFAULT     t   ALTER TABLE ONLY public.tbl_roles ALTER COLUMN id_rol SET DEFAULT nextval('public.tbl_roles_id_rol_seq'::regclass);
 ?   ALTER TABLE public.tbl_roles ALTER COLUMN id_rol DROP DEFAULT;
       public          postgres    false    250    249    250            �           2604    17198    tbl_sedes id_sede    DEFAULT     v   ALTER TABLE ONLY public.tbl_sedes ALTER COLUMN id_sede SET DEFAULT nextval('public.tbl_sedes_id_sede_seq'::regclass);
 @   ALTER TABLE public.tbl_sedes ALTER COLUMN id_sede DROP DEFAULT;
       public          postgres    false    252    251    252            �           2604    17203    tbl_sexo id_sexo    DEFAULT     t   ALTER TABLE ONLY public.tbl_sexo ALTER COLUMN id_sexo SET DEFAULT nextval('public.tbl_sexo_id_sexo_seq'::regclass);
 ?   ALTER TABLE public.tbl_sexo ALTER COLUMN id_sexo DROP DEFAULT;
       public          postgres    false    253    254    254            �           2604    17210    tbl_usu id_usu    DEFAULT     p   ALTER TABLE ONLY public.tbl_usu ALTER COLUMN id_usu SET DEFAULT nextval('public.tbl_usu_id_usu_seq'::regclass);
 =   ALTER TABLE public.tbl_usu ALTER COLUMN id_usu DROP DEFAULT;
       public          postgres    false    256    255    256            P          0    17096    tbl_agresor 
   TABLE DATA                 public          postgres    false    216   ��       Q          0    17100    tbl_citaciones 
   TABLE DATA                 public          postgres    false    217   ��       S          0    17104    tbl_departamento 
   TABLE DATA                 public          postgres    false    219   ˯       U          0    17109    tbl_dependencia 
   TABLE DATA                 public          postgres    false    221   �       V          0    17113    tbl_dictamenes 
   TABLE DATA                 public          postgres    false    222   �       X          0    17117    tbl_escolaridad 
   TABLE DATA                 public          postgres    false    224   &�       Z          0    17122    tbl_estado_civil 
   TABLE DATA                 public          postgres    false    226   @�       \          0    17129    tbl_estados 
   TABLE DATA                 public          postgres    false    228   Z�       ]          0    17135    tbl_evaluacion 
   TABLE DATA                 public          postgres    false    229   t�       _          0    17139    tbl_evaluado 
   TABLE DATA                 public          postgres    false    231   ��       `          0    17143 	   tbl_hecho 
   TABLE DATA                 public          postgres    false    232   ��       b          0    17147    tbl_instrumento 
   TABLE DATA                 public          postgres    false    234   ±       d          0    17152    tbl_jornada 
   TABLE DATA                 public          postgres    false    236   ܱ       f          0    17159    tbl_municipio 
   TABLE DATA                 public          postgres    false    238   ��       h          0    17164    tbl_nacionalidad 
   TABLE DATA                 public          postgres    false    240   �       j          0    17169    tbl_ocupaciones 
   TABLE DATA                 public          postgres    false    242   .�       l          0    17174    tbl_proveidos 
   TABLE DATA                 public          postgres    false    244   H�       n          0    17179    tbl_puestos 
   TABLE DATA                 public          postgres    false    246   b�       p          0    17184    tbl_reconocimiento 
   TABLE DATA                 public          postgres    false    248   |�       r          0    17189 	   tbl_roles 
   TABLE DATA                 public          postgres    false    250   ��       t          0    17195 	   tbl_sedes 
   TABLE DATA                 public          postgres    false    252   ��       v          0    17200    tbl_sexo 
   TABLE DATA                 public          postgres    false    254   ʽ       x          0    17207    tbl_usu 
   TABLE DATA                 public          postgres    false    256   �       �           0    0    tbl_agresor_id_agresor_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.tbl_agresor_id_agresor_seq', 1, false);
          public          postgres    false    215            �           0    0 $   tbl_departamento_id_departamento_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.tbl_departamento_id_departamento_seq', 18, true);
          public          postgres    false    218            �           0    0 "   tbl_dependencia_id_dependencia_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.tbl_dependencia_id_dependencia_seq', 1, false);
          public          postgres    false    220            �           0    0 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.tbl_escolaridad_id_escolaridad_seq', 1, false);
          public          postgres    false    223            �           0    0 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.tbl_estado_civil_id_estado_civil_seq', 1, false);
          public          postgres    false    225            �           0    0    tbl_estados_id_estado_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tbl_estados_id_estado_seq', 1, false);
          public          postgres    false    227            �           0    0    tbl_evaluado_id_evaluado_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.tbl_evaluado_id_evaluado_seq', 1, false);
          public          postgres    false    230            �           0    0 "   tbl_instrumento_id_instrumento_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.tbl_instrumento_id_instrumento_seq', 1, false);
          public          postgres    false    233            �           0    0    tbl_jornada_id_jornada_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.tbl_jornada_id_jornada_seq', 1, false);
          public          postgres    false    235            �           0    0    tbl_municipio_id_municipio_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tbl_municipio_id_municipio_seq', 1136, true);
          public          postgres    false    237            �           0    0 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.tbl_nacionalidad_id_nacionalidad_seq', 1, false);
          public          postgres    false    239            �           0    0     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tbl_ocupaciones_id_ocupacion_seq', 1, false);
          public          postgres    false    241            �           0    0    tbl_proveidos_id_proveidos_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tbl_proveidos_id_proveidos_seq', 1, false);
          public          postgres    false    243            �           0    0    tbl_puestos_id_puesto_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tbl_puestos_id_puesto_seq', 1, false);
          public          postgres    false    245            �           0    0 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE SET     W   SELECT pg_catalog.setval('public.tbl_reconocimiento_id_reconocimiento_seq', 1, false);
          public          postgres    false    247            �           0    0    tbl_roles_id_rol_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tbl_roles_id_rol_seq', 1, false);
          public          postgres    false    249            �           0    0    tbl_sedes_id_sede_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.tbl_sedes_id_sede_seq', 1, false);
          public          postgres    false    251            �           0    0    tbl_sexo_id_sexo_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tbl_sexo_id_sexo_seq', 1, false);
          public          postgres    false    253            �           0    0    tbl_usu_id_usu_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.tbl_usu_id_usu_seq', 1, true);
          public          postgres    false    255            �           2606    17212    tbl_estados estados_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tbl_estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id_estado);
 B   ALTER TABLE ONLY public.tbl_estados DROP CONSTRAINT estados_pkey;
       public            postgres    false    228            �           2606    17214    tbl_agresor tbl_agresor_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tbl_agresor
    ADD CONSTRAINT tbl_agresor_pkey PRIMARY KEY (id_agresor);
 F   ALTER TABLE ONLY public.tbl_agresor DROP CONSTRAINT tbl_agresor_pkey;
       public            postgres    false    216            �           2606    17216 &   tbl_departamento tbl_departamento_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_departamento
    ADD CONSTRAINT tbl_departamento_pkey PRIMARY KEY (id_departamento);
 P   ALTER TABLE ONLY public.tbl_departamento DROP CONSTRAINT tbl_departamento_pkey;
       public            postgres    false    219            �           2606    17218 $   tbl_dependencia tbl_dependencia_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_dependencia
    ADD CONSTRAINT tbl_dependencia_pkey PRIMARY KEY (id_dependencia);
 N   ALTER TABLE ONLY public.tbl_dependencia DROP CONSTRAINT tbl_dependencia_pkey;
       public            postgres    false    221            �           2606    17220 $   tbl_escolaridad tbl_escolaridad_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_escolaridad
    ADD CONSTRAINT tbl_escolaridad_pkey PRIMARY KEY (id_escolaridad);
 N   ALTER TABLE ONLY public.tbl_escolaridad DROP CONSTRAINT tbl_escolaridad_pkey;
       public            postgres    false    224            �           2606    17222 &   tbl_estado_civil tbl_estado_civil_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_estado_civil
    ADD CONSTRAINT tbl_estado_civil_pkey PRIMARY KEY (id_estado_civil);
 P   ALTER TABLE ONLY public.tbl_estado_civil DROP CONSTRAINT tbl_estado_civil_pkey;
       public            postgres    false    226            �           2606    17224    tbl_evaluado tbl_evaluado_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT tbl_evaluado_pkey PRIMARY KEY (id_evaluado);
 H   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT tbl_evaluado_pkey;
       public            postgres    false    231            �           2606    17226 $   tbl_instrumento tbl_instrumento_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_instrumento
    ADD CONSTRAINT tbl_instrumento_pkey PRIMARY KEY (id_instrumento);
 N   ALTER TABLE ONLY public.tbl_instrumento DROP CONSTRAINT tbl_instrumento_pkey;
       public            postgres    false    234            �           2606    17228    tbl_jornada tbl_jornada_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tbl_jornada
    ADD CONSTRAINT tbl_jornada_pkey PRIMARY KEY (id_jornada);
 F   ALTER TABLE ONLY public.tbl_jornada DROP CONSTRAINT tbl_jornada_pkey;
       public            postgres    false    236            �           2606    17230     tbl_municipio tbl_municipio_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tbl_municipio
    ADD CONSTRAINT tbl_municipio_pkey PRIMARY KEY (id_municipio);
 J   ALTER TABLE ONLY public.tbl_municipio DROP CONSTRAINT tbl_municipio_pkey;
       public            postgres    false    238            �           2606    17232 &   tbl_nacionalidad tbl_nacionalidad_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_nacionalidad
    ADD CONSTRAINT tbl_nacionalidad_pkey PRIMARY KEY (id_nacionalidad);
 P   ALTER TABLE ONLY public.tbl_nacionalidad DROP CONSTRAINT tbl_nacionalidad_pkey;
       public            postgres    false    240            �           2606    17234 $   tbl_ocupaciones tbl_ocupaciones_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.tbl_ocupaciones
    ADD CONSTRAINT tbl_ocupaciones_pkey PRIMARY KEY (id_ocupacion);
 N   ALTER TABLE ONLY public.tbl_ocupaciones DROP CONSTRAINT tbl_ocupaciones_pkey;
       public            postgres    false    242            �           2606    17236     tbl_proveidos tbl_proveidos_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tbl_proveidos
    ADD CONSTRAINT tbl_proveidos_pkey PRIMARY KEY (id_proveidos);
 J   ALTER TABLE ONLY public.tbl_proveidos DROP CONSTRAINT tbl_proveidos_pkey;
       public            postgres    false    244            �           2606    17238    tbl_puestos tbl_puestos_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.tbl_puestos
    ADD CONSTRAINT tbl_puestos_pkey PRIMARY KEY (id_puesto);
 F   ALTER TABLE ONLY public.tbl_puestos DROP CONSTRAINT tbl_puestos_pkey;
       public            postgres    false    246            �           2606    17240 *   tbl_reconocimiento tbl_reconocimiento_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY public.tbl_reconocimiento
    ADD CONSTRAINT tbl_reconocimiento_pkey PRIMARY KEY (id_reconocimiento);
 T   ALTER TABLE ONLY public.tbl_reconocimiento DROP CONSTRAINT tbl_reconocimiento_pkey;
       public            postgres    false    248            �           2606    17242    tbl_sedes tbl_sedes_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.tbl_sedes
    ADD CONSTRAINT tbl_sedes_pkey PRIMARY KEY (id_sede);
 B   ALTER TABLE ONLY public.tbl_sedes DROP CONSTRAINT tbl_sedes_pkey;
       public            postgres    false    252            �           2606    17244    tbl_sexo tbl_sexo_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.tbl_sexo
    ADD CONSTRAINT tbl_sexo_pkey PRIMARY KEY (id_sexo);
 @   ALTER TABLE ONLY public.tbl_sexo DROP CONSTRAINT tbl_sexo_pkey;
       public            postgres    false    254            �           2606    17246    tbl_usu tbl_usu_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.tbl_usu
    ADD CONSTRAINT tbl_usu_pkey PRIMARY KEY (id_usu);
 >   ALTER TABLE ONLY public.tbl_usu DROP CONSTRAINT tbl_usu_pkey;
       public            postgres    false    256            �           2606    17247    tbl_municipio fk_departamento    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_municipio
    ADD CONSTRAINT fk_departamento FOREIGN KEY (id_departamento) REFERENCES public.tbl_departamento(id_departamento);
 G   ALTER TABLE ONLY public.tbl_municipio DROP CONSTRAINT fk_departamento;
       public          postgres    false    4762    238    219            �           2606    17252    tbl_puestos fk_jornada    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_puestos
    ADD CONSTRAINT fk_jornada FOREIGN KEY (id_puesto) REFERENCES public.tbl_jornada(id_jornada);
 @   ALTER TABLE ONLY public.tbl_puestos DROP CONSTRAINT fk_jornada;
       public          postgres    false    236    246    4776            �           2606    17257    tbl_evaluado fk_proveido    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT fk_proveido FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 B   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT fk_proveido;
       public          postgres    false    4784    231    244            �           2606    17262 %   tbl_evaluacion fk_proveido_evaluacion    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluacion
    ADD CONSTRAINT fk_proveido_evaluacion FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 O   ALTER TABLE ONLY public.tbl_evaluacion DROP CONSTRAINT fk_proveido_evaluacion;
       public          postgres    false    244    4784    229            �           2606    17267    tbl_hecho fk_proveido_hechos    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_hecho
    ADD CONSTRAINT fk_proveido_hechos FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 F   ALTER TABLE ONLY public.tbl_hecho DROP CONSTRAINT fk_proveido_hechos;
       public          postgres    false    244    4784    232            P   
   x���          Q   
   x���          S     x���KN�0�}N�]AB��X(RhPS*u�&�E,M��8���R��pƹ�� �<�tY$��H��\tC�Z���+ՁuШ��YdoI!��1[8�c�t��(e�3����)�����-W^L��/��m/'���\y5I���z��&��x~�.�!�d����F����*���^�xԆ�F<�)e���:�-��WJ �{�����8�.:�MC�2�t��ۆ���8թ�A�y^��Ú��8D������hK8`��� ���;ME�b�j      U   
   x���          V   
   x���          X   
   x���          Z   
   x���          \   
   x���          ]   
   x���          _   
   x���          `   
   x���          b   
   x���          d   
   x���          f     x��\�n#���W��&�����=���b{L6����M�9��U�#��$_�Oɗ��HJ�d��xw��8�w���������y�-�anM��nn�V��Tfm\�4��t�P�nҟ�\��T����(���7zp�3[�9�M7��	J$h��w�_��2tF��~���jM%� ����ܫ�2m��C�x�V��#@μyq� <Ɵ�ae��E�x�	�O���:���.����a�(�+S���-��?��^��N�����kU�Q�ex�!��n��i�UN E����t���F�f,�Ew�j�6�k��਺�*tڛ�A���h��@~l���\�5�����?�:|�o|ԋV���5��� ��Z5�����1ɏ���
��'�ʻ֪�+���M�Z|u�^p�(�ەkӳ��49�K��n�����q�p���\����}2tݝׂ�'�X\��d�=W-x��OA��9tz�%Va��|7H�W3k:0t���Ki�+�X�1�d��v19�1�n}̀Ǆr=Us���Y�FO���7�^W&zi&AI���>���S���?@Q��*��ń� ?:����1�J7��{�g�X\y�����	P��|��|�$��K#:���|��װ�ST�M��T1�Z���2��o;�x��nm���u@Po�;?�� �k���(G���T�
�t����Na��N��)�G1�[��1��	��ʇ>��=��!P�8�q�5|�T�(���	�(�;SS��G�cP�	j�'@��A��
��^��d��5GH�&�����V���!�j��l|y�y��K�B�2OZ^>~���Y���!#��͈G��֪26yz&~�6��S�V���O5"��=��gb���0ס��'�.4_�R�mW��a�x���Fp�=T��-����� '�0��Q}w�]������<ǌL��/Z=%?ڏ������h#-pL��˞5��|-<L��(]A���}�̪@�dbQ�Uc�;ݙ��_A�n��`T䥪�ձ�΄S��DƄ����������<93����yT�\��	���vF����YK|Lp��a�Z���@}�G��q�h�ਅ�[����)��_��I���\9��i;�e�S8:OU�	�eJ�*��R6l4uTN1�h�X��/��l�]C&A4w
BG2�L�ࠦ�$F����0�T+�k�mf0	�1�RF�������Yj�9��S#�vG# �d���Ω�r��I��23W�ZBT����蝠/��\9�;	�Q����{ʱ�Ų�<��	r�E������5F�n�O1����6%,5�Ud�K�G�.�s+@��Z��
^�,�\�R�tBv��\ü�*M0�;��+]C���2�q�8O|���24j8?
��PT#=�m�ުm4��z*�
�
��
����p�J���uh�_>>l�ڵ������1���6��W�.�ծ�R݆K�W�0��4y�h����� :T�n_��@�s��sYb�f� 5�UP��Z�x^�/��;%\��k�>���%�gw�-|<�E�1|��q9F��0�<�Ƣ�2+�x��}��(�:ua�����F��c�@�Ш���Q�iF�����8+�C�~����6�J�������Lc�p�i�i2 6�����O��س�(5�?�RX��M�\�؜��+�S�\��@��k�+����ԁME�o�=��(���~c��ek9hW��{f���IPl���>�.X�f�{9�`[?�~�K�̓6�(.G/'CF-�D�7�R�[j�|V>��(�_=$��氦� �R=�l����`-�U>:T.�0���q�4̓Նls��h�le ܕ$��c���@�!�S+�༬��<�3y���!e<��T�\���]XH�TG���!��uj��3w�~;C�^�AL)!��8�B.�M�&N^P��Yw�����ܫ/��8�9ڝ�e�l�N8�3Jl�A�|�d����T*|�Ѩ�GWˬ5o�J����<��iDb����t�����^�m嶣�%k���/��Mc���+\����R@Ы�E4�\�&�����l���9k*�J.Z�(����y	�
y=�CI����A��2=��e8F��v�*K趟1�������I���\��}t���l<e>�	��G.|t����4���`+�kU���aB�&u��dk���\���ܓ	�6��h�36u��3�ڷ�5�+5�!�-e�C�U��v	:x���Z�w��jD��E�\|,�7�`��,~+E�'5�v���l���Y�AP)������/Nt�k�\�����o[����#���5Mްɨvdl%���]%u��Td?�-�(?O֐eyL-��We:���7�*���*d��%�������-��k�X�Mv8G�c�d�w���P嚻�~�\���N��0L���������f��b;�K[�"X|Iݞ줭R7�K�
�cV�����GwNt���l�ڤq\
T㟃�M�Zx\��{��v����.�����l��l]������.�M������	������S���!{�'Sa+�FXu�C_.����e���R�^�v�yr���ND��\��ɀ�F�N3G���.���k�NF�	�%�^�*~�&��`��r���q
z�r�M��M���~7�<��|������n�KA��M˚���ޣ�����K�<�!��p!K�[	�.s�����{Q"85�-��Y��~���rH�!��\t��U�R�O������PJ�      h   
   x���          j   
   x���          l   
   x���          n   
   x���          p   
   x���          r   
   x���          t   
   x���          v   
   x���          x   �   x���v
Q���W((M��L�+Iʉ/-.Us�	uV�0�QPwt���S��H�/*J�w�Pz��� A�JC��4g#��P�l}g���4�ܲT�T�`�t����2����c������4�Rs�T�~CRwTG#4���� ��1�     