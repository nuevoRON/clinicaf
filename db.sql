PGDMP              	    	    |            clinica    16.3    16.3               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    17291    clinica    DATABASE     }   CREATE DATABASE clinica WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Honduras.1252';
    DROP DATABASE clinica;
                postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false                       0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    4            �            1259    17292    tbl_agresor    TABLE     u   CREATE TABLE public.tbl_agresor (
    id_agresor integer NOT NULL,
    nom_agresor character varying(50) NOT NULL
);
    DROP TABLE public.tbl_agresor;
       public         heap    postgres    false    4            	           0    0    TABLE tbl_agresor    COMMENT     o   COMMENT ON TABLE public.tbl_agresor IS 'en esta tabla se agregaran los agresores utilizados en la aplicacion';
          public          postgres    false    216            �            1259    17295    tbl_agresor_id_agresor_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_agresor_id_agresor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tbl_agresor_id_agresor_seq;
       public          postgres    false    4    216            
           0    0    tbl_agresor_id_agresor_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tbl_agresor_id_agresor_seq OWNED BY public.tbl_agresor.id_agresor;
          public          postgres    false    217                       1259    25684    tbl_bitacora    TABLE     �   CREATE TABLE public.tbl_bitacora (
    id_bitacora integer NOT NULL,
    id_usuario integer,
    id_modulo integer,
    accion character varying(30),
    descripcion character varying(100),
    fecha_accion timestamp without time zone
);
     DROP TABLE public.tbl_bitacora;
       public         heap    postgres    false    4                       1259    25683    tbl_bitacora_id_bitacora_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_bitacora_id_bitacora_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.tbl_bitacora_id_bitacora_seq;
       public          postgres    false    276    4                       0    0    tbl_bitacora_id_bitacora_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.tbl_bitacora_id_bitacora_seq OWNED BY public.tbl_bitacora.id_bitacora;
          public          postgres    false    275            �            1259    17296    tbl_citaciones    TABLE     Z  CREATE TABLE public.tbl_citaciones (
    numero_caso integer NOT NULL,
    tipo_citacion character varying(15) NOT NULL,
    fecha_recep_citacion date NOT NULL,
    fecha_citacion date NOT NULL,
    medico integer NOT NULL,
    lugar_citacion character varying(255),
    id_citacion integer NOT NULL,
    registro_borrado character varying(1)
);
 "   DROP TABLE public.tbl_citaciones;
       public         heap    postgres    false    4                       1259    25574    tbl_citaciones_id_citacion_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_citaciones_id_citacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tbl_citaciones_id_citacion_seq;
       public          postgres    false    218    4                       0    0    tbl_citaciones_id_citacion_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tbl_citaciones_id_citacion_seq OWNED BY public.tbl_citaciones.id_citacion;
          public          postgres    false    263                       1259    25499    tbl_clinicas    TABLE     �   CREATE TABLE public.tbl_clinicas (
    id_clinica integer NOT NULL,
    nombre character varying(100) NOT NULL,
    codigo_alfabetico character varying(4) NOT NULL,
    codigo_numerico character varying(5) NOT NULL
);
     DROP TABLE public.tbl_clinicas;
       public         heap    postgres    false    4                       1259    25542    tbl_correlativo_caso    TABLE     �   CREATE TABLE public.tbl_correlativo_caso (
    id integer NOT NULL,
    sede character varying(5),
    ultimo_correlativo integer,
    anio integer
);
 (   DROP TABLE public.tbl_correlativo_caso;
       public         heap    postgres    false    4                       1259    25541    tbl_correlativo_caso_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_correlativo_caso_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.tbl_correlativo_caso_id_seq;
       public          postgres    false    262    4                       0    0    tbl_correlativo_caso_id_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.tbl_correlativo_caso_id_seq OWNED BY public.tbl_correlativo_caso.id;
          public          postgres    false    261                       1259    25525    tbl_correlativos_solicitud    TABLE     �   CREATE TABLE public.tbl_correlativos_solicitud (
    id integer NOT NULL,
    sede character varying(5) NOT NULL,
    laboratorio character varying(5) NOT NULL,
    ultimo_correlativo integer NOT NULL,
    anio integer
);
 .   DROP TABLE public.tbl_correlativos_solicitud;
       public         heap    postgres    false    4                       1259    25524 !   tbl_correlativos_solicitud_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_correlativos_solicitud_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.tbl_correlativos_solicitud_id_seq;
       public          postgres    false    4    260                       0    0 !   tbl_correlativos_solicitud_id_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.tbl_correlativos_solicitud_id_seq OWNED BY public.tbl_correlativos_solicitud.id;
          public          postgres    false    259            �            1259    17299    tbl_departamento    TABLE     ~   CREATE TABLE public.tbl_departamento (
    id_departamento integer NOT NULL,
    nombre_departamento character varying(50)
);
 $   DROP TABLE public.tbl_departamento;
       public         heap    postgres    false    4            �            1259    17302 $   tbl_departamento_id_departamento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_departamento_id_departamento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_departamento_id_departamento_seq;
       public          postgres    false    4    219                       0    0 $   tbl_departamento_id_departamento_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_departamento_id_departamento_seq OWNED BY public.tbl_departamento.id_departamento;
          public          postgres    false    220            �            1259    17303    tbl_dependencia    TABLE     �   CREATE TABLE public.tbl_dependencia (
    id_dependencia integer NOT NULL,
    nom_dependencia character varying(80) NOT NULL,
    registro_borrado character(1)
);
 #   DROP TABLE public.tbl_dependencia;
       public         heap    postgres    false    4                       0    0    TABLE tbl_dependencia    COMMENT     ~   COMMENT ON TABLE public.tbl_dependencia IS 'en esta tabla se agregaran las dependencias que solicitan analisis a la clinica';
          public          postgres    false    221            �            1259    17306 "   tbl_dependencia_id_dependencia_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_dependencia_id_dependencia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_dependencia_id_dependencia_seq;
       public          postgres    false    4    221                       0    0 "   tbl_dependencia_id_dependencia_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_dependencia_id_dependencia_seq OWNED BY public.tbl_dependencia.id_dependencia;
          public          postgres    false    222                       1259    25874    tbl_dictamen_transcripcion    TABLE     S  CREATE TABLE public.tbl_dictamen_transcripcion (
    id integer NOT NULL,
    id_dictamen integer,
    medico integer,
    fecha_evaluacion date,
    autoridad_solicitante character varying(100),
    fecha_entrega date,
    datos_extra character varying(100),
    registro_borrado character(1),
    tipo_documento character varying(15)
);
 .   DROP TABLE public.tbl_dictamen_transcripcion;
       public         heap    postgres    false    4                       1259    25873 !   tbl_dictamen_transcripcion_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_dictamen_transcripcion_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.tbl_dictamen_transcripcion_id_seq;
       public          postgres    false    4    278                       0    0 !   tbl_dictamen_transcripcion_id_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.tbl_dictamen_transcripcion_id_seq OWNED BY public.tbl_dictamen_transcripcion.id;
          public          postgres    false    277            �            1259    17307    tbl_dictamenes    TABLE     J  CREATE TABLE public.tbl_dictamenes (
    numero_caso integer NOT NULL,
    medico integer NOT NULL,
    fecha_evaluacion date,
    autoridad_solicitante character varying(100) NOT NULL,
    fecha_entrega date NOT NULL,
    datos_extra character varying(255),
    id_dictamen integer NOT NULL,
    registro_borrado character(1)
);
 "   DROP TABLE public.tbl_dictamenes;
       public         heap    postgres    false    4                       1259    25581    tbl_dictamenes_id_dictamen_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_dictamenes_id_dictamen_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tbl_dictamenes_id_dictamen_seq;
       public          postgres    false    4    223                       0    0    tbl_dictamenes_id_dictamen_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tbl_dictamenes_id_dictamen_seq OWNED BY public.tbl_dictamenes.id_dictamen;
          public          postgres    false    264            �            1259    17310    tbl_escolaridad    TABLE     �   CREATE TABLE public.tbl_escolaridad (
    id_escolaridad integer NOT NULL,
    nom_escolaridad character varying(30) NOT NULL
);
 #   DROP TABLE public.tbl_escolaridad;
       public         heap    postgres    false    4            �            1259    17313 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_escolaridad_id_escolaridad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_escolaridad_id_escolaridad_seq;
       public          postgres    false    224    4                       0    0 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_escolaridad_id_escolaridad_seq OWNED BY public.tbl_escolaridad.id_escolaridad;
          public          postgres    false    225            �            1259    17314    tbl_estado_civil    TABLE     z   CREATE TABLE public.tbl_estado_civil (
    id_estado_civil integer NOT NULL,
    nom_estado character varying NOT NULL
);
 $   DROP TABLE public.tbl_estado_civil;
       public         heap    postgres    false    4            �            1259    17319 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_estado_civil_id_estado_civil_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_estado_civil_id_estado_civil_seq;
       public          postgres    false    4    226                       0    0 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_estado_civil_id_estado_civil_seq OWNED BY public.tbl_estado_civil.id_estado_civil;
          public          postgres    false    227            �            1259    17320    tbl_estados    TABLE     o   CREATE TABLE public.tbl_estados (
    id_estado integer NOT NULL,
    nom_estado character varying NOT NULL
);
    DROP TABLE public.tbl_estados;
       public         heap    postgres    false    4            �            1259    17325    tbl_estados_id_estado_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_estados_id_estado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tbl_estados_id_estado_seq;
       public          postgres    false    228    4                       0    0    tbl_estados_id_estado_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tbl_estados_id_estado_seq OWNED BY public.tbl_estados.id_estado;
          public          postgres    false    229            �            1259    17326    tbl_evaluacion    TABLE     h  CREATE TABLE public.tbl_evaluacion (
    consentimiento_informado character varying(35),
    instrumento_agresion integer,
    descripcion_evaluacion character varying(255),
    relacion_agresor character varying(20),
    especificar_relacion character varying(50),
    sede_evaluacion integer,
    fecha_finalizacion date,
    id_proveido integer NOT NULL
);
 "   DROP TABLE public.tbl_evaluacion;
       public         heap    postgres    false    4            �            1259    17329    tbl_evaluado    TABLE       CREATE TABLE public.tbl_evaluado (
    id_evaluado integer NOT NULL,
    nombre_evaluado character varying(50) NOT NULL,
    apellido_evaluado character varying(50) NOT NULL,
    dni_evaluado character varying(15) NOT NULL,
    telefono_evaluado character varying(15),
    id_sexo integer,
    edad integer,
    diversidad character varying(20),
    tiempo character varying(10),
    nombre_acompanante character varying(50),
    apellido_acompanante character varying(50),
    relacion_acompanante character varying(50),
    id_proveido integer NOT NULL,
    estado_evaluacion character varying(15),
    nacionalidad integer,
    estado_civil integer,
    ocupacion integer,
    lugar_procedencia character varying(100),
    escolaridad integer,
    dni_acompanante character varying(15)
);
     DROP TABLE public.tbl_evaluado;
       public         heap    postgres    false    4            �            1259    17332    tbl_evaluado_id_evaluado_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_evaluado_id_evaluado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.tbl_evaluado_id_evaluado_seq;
       public          postgres    false    231    4                       0    0    tbl_evaluado_id_evaluado_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.tbl_evaluado_id_evaluado_seq OWNED BY public.tbl_evaluado.id_evaluado;
          public          postgres    false    232            �            1259    17333 	   tbl_hecho    TABLE     �   CREATE TABLE public.tbl_hecho (
    id_departamento integer,
    id_municipio integer,
    localidad character varying(100),
    lugar_hecho character varying(30),
    fecha_hecho date,
    id_proveido integer NOT NULL
);
    DROP TABLE public.tbl_hecho;
       public         heap    postgres    false    4            �            1259    17336    tbl_instrumento    TABLE     �   CREATE TABLE public.tbl_instrumento (
    id_instrumento integer NOT NULL,
    nom_instrumento character varying(50) NOT NULL
);
 #   DROP TABLE public.tbl_instrumento;
       public         heap    postgres    false    4            �            1259    17339 "   tbl_instrumento_id_instrumento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_instrumento_id_instrumento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_instrumento_id_instrumento_seq;
       public          postgres    false    4    234                       0    0 "   tbl_instrumento_id_instrumento_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_instrumento_id_instrumento_seq OWNED BY public.tbl_instrumento.id_instrumento;
          public          postgres    false    235            �            1259    17340    tbl_jornada    TABLE     h   CREATE TABLE public.tbl_jornada (
    id_jornada integer NOT NULL,
    nom_jornada character varying
);
    DROP TABLE public.tbl_jornada;
       public         heap    postgres    false    4            �            1259    17345    tbl_jornada_id_jornada_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_jornada_id_jornada_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tbl_jornada_id_jornada_seq;
       public          postgres    false    4    236                       0    0    tbl_jornada_id_jornada_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tbl_jornada_id_jornada_seq OWNED BY public.tbl_jornada.id_jornada;
          public          postgres    false    237                       1259    25618    tbl_modulos    TABLE     ^  CREATE TABLE public.tbl_modulos (
    id integer NOT NULL,
    nombre character varying(30),
    fecha_creacion timestamp without time zone,
    creado_por character varying(30),
    fecha_modificacion timestamp without time zone,
    registro_borrado character(1),
    descripcion character varying(100),
    modificado_por character varying(30)
);
    DROP TABLE public.tbl_modulos;
       public         heap    postgres    false    4                       1259    25617    tbl_modulos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_modulos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tbl_modulos_id_seq;
       public          postgres    false    4    268                       0    0    tbl_modulos_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tbl_modulos_id_seq OWNED BY public.tbl_modulos.id;
          public          postgres    false    267            �            1259    17346    tbl_municipio    TABLE     �   CREATE TABLE public.tbl_municipio (
    id_municipio integer NOT NULL,
    nombre_municipio character varying(100),
    id_departamento integer NOT NULL
);
 !   DROP TABLE public.tbl_municipio;
       public         heap    postgres    false    4            �            1259    17349    tbl_municipio_id_municipio_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_municipio_id_municipio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tbl_municipio_id_municipio_seq;
       public          postgres    false    4    238                       0    0    tbl_municipio_id_municipio_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tbl_municipio_id_municipio_seq OWNED BY public.tbl_municipio.id_municipio;
          public          postgres    false    239            �            1259    17350    tbl_nacionalidad    TABLE     �   CREATE TABLE public.tbl_nacionalidad (
    id_nacionalidad integer NOT NULL,
    nom_nacionalidad character varying(30) NOT NULL
);
 $   DROP TABLE public.tbl_nacionalidad;
       public         heap    postgres    false    4            �            1259    17353 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq;
       public          postgres    false    4    240                       0    0 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.tbl_nacionalidad_id_nacionalidad_seq OWNED BY public.tbl_nacionalidad.id_nacionalidad;
          public          postgres    false    241            �            1259    17354    tbl_ocupaciones    TABLE     }   CREATE TABLE public.tbl_ocupaciones (
    id_ocupacion integer NOT NULL,
    nom_ocupacion character varying(60) NOT NULL
);
 #   DROP TABLE public.tbl_ocupaciones;
       public         heap    postgres    false    4            �            1259    17357     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq;
       public          postgres    false    242    4                       0    0     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.tbl_ocupaciones_id_ocupacion_seq OWNED BY public.tbl_ocupaciones.id_ocupacion;
          public          postgres    false    243                       1259    25625    tbl_permisos    TABLE       CREATE TABLE public.tbl_permisos (
    id integer NOT NULL,
    id_modulo integer,
    id_puesto integer,
    consulta character(1),
    insercion character(1),
    actualizacion character(1),
    eliminacion character(1),
    registro_borrado character(1)
);
     DROP TABLE public.tbl_permisos;
       public         heap    postgres    false    4                       1259    25624    tbl_permisos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_permisos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.tbl_permisos_id_seq;
       public          postgres    false    4    270                       0    0    tbl_permisos_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.tbl_permisos_id_seq OWNED BY public.tbl_permisos.id;
          public          postgres    false    269                       1259    25671    tbl_plantillas    TABLE     q   CREATE TABLE public.tbl_plantillas (
    id_archivo integer NOT NULL,
    ruta_archivo character varying(255)
);
 "   DROP TABLE public.tbl_plantillas;
       public         heap    postgres    false    4                       1259    25670    tbl_plantillas_id_archivo_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_plantillas_id_archivo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.tbl_plantillas_id_archivo_seq;
       public          postgres    false    4    274                       0    0    tbl_plantillas_id_archivo_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.tbl_plantillas_id_archivo_seq OWNED BY public.tbl_plantillas.id_archivo;
          public          postgres    false    273                       1259    25493    tbl_proveido_reconocimiento    TABLE     �   CREATE TABLE public.tbl_proveido_reconocimiento (
    id_proveido_reconocimiento integer NOT NULL,
    tipo_reconocimiento integer,
    medico integer,
    fecha_citacion date
);
 /   DROP TABLE public.tbl_proveido_reconocimiento;
       public         heap    postgres    false    4                        1259    25492 :   tbl_proveido_reconocimiento_id_proveido_reconocimiento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_proveido_reconocimiento_id_proveido_reconocimiento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 Q   DROP SEQUENCE public.tbl_proveido_reconocimiento_id_proveido_reconocimiento_seq;
       public          postgres    false    257    4                        0    0 :   tbl_proveido_reconocimiento_id_proveido_reconocimiento_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.tbl_proveido_reconocimiento_id_proveido_reconocimiento_seq OWNED BY public.tbl_proveido_reconocimiento.id_proveido_reconocimiento;
          public          postgres    false    256            �            1259    17358    tbl_proveidos    TABLE     �  CREATE TABLE public.tbl_proveidos (
    id_proveidos integer NOT NULL,
    num_caso character varying(20) NOT NULL,
    num_caso_ext character varying(20),
    fech_emi_soli date NOT NULL,
    fech_recep_soli date NOT NULL,
    fiscalia_remitente integer NOT NULL,
    registro_borrado character(1),
    num_solicitud character varying(20),
    especifique_cual character varying(30)
);
 !   DROP TABLE public.tbl_proveidos;
       public         heap    postgres    false    4            �            1259    17361    tbl_proveidos_id_proveidos_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_proveidos_id_proveidos_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tbl_proveidos_id_proveidos_seq;
       public          postgres    false    244    4            !           0    0    tbl_proveidos_id_proveidos_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tbl_proveidos_id_proveidos_seq OWNED BY public.tbl_proveidos.id_proveidos;
          public          postgres    false    245            �            1259    17362    tbl_puestos    TABLE     �   CREATE TABLE public.tbl_puestos (
    id_puesto integer NOT NULL,
    nom_puesto character varying(25) NOT NULL,
    estado character varying(25) NOT NULL
);
    DROP TABLE public.tbl_puestos;
       public         heap    postgres    false    4            �            1259    17365    tbl_puestos_id_puesto_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_puestos_id_puesto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tbl_puestos_id_puesto_seq;
       public          postgres    false    4    246            "           0    0    tbl_puestos_id_puesto_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tbl_puestos_id_puesto_seq OWNED BY public.tbl_puestos.id_puesto;
          public          postgres    false    247            �            1259    17366    tbl_reconocimiento    TABLE     �   CREATE TABLE public.tbl_reconocimiento (
    id_reconocimiento integer NOT NULL,
    nom_reconocimiento character varying(60) NOT NULL
);
 &   DROP TABLE public.tbl_reconocimiento;
       public         heap    postgres    false    4            �            1259    17369 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ?   DROP SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq;
       public          postgres    false    4    248            #           0    0 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE OWNED BY     u   ALTER SEQUENCE public.tbl_reconocimiento_id_reconocimiento_seq OWNED BY public.tbl_reconocimiento.id_reconocimiento;
          public          postgres    false    249            
           1259    25609    tbl_revision_casos    TABLE     ?  CREATE TABLE public.tbl_revision_casos (
    id_revision integer NOT NULL,
    medico integer,
    enviado_para character varying(10),
    fecha_revision date,
    tipo_dictamen character varying(20),
    numero_dictamen character varying(30),
    nombre_evaluado character varying(100),
    fecha_evaluacion date,
    tipo_reconocimiento integer,
    obs_reconocimiento character varying(255),
    estado_dictamen character varying(80),
    obs_dictamen character varying(255),
    sede_medico character varying(20),
    sede_clinica integer,
    registro_borrado bpchar
);
 &   DROP TABLE public.tbl_revision_casos;
       public         heap    postgres    false    4            	           1259    25608 "   tbl_revision_casos_id_revision_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_revision_casos_id_revision_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.tbl_revision_casos_id_revision_seq;
       public          postgres    false    266    4            $           0    0 "   tbl_revision_casos_id_revision_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.tbl_revision_casos_id_revision_seq OWNED BY public.tbl_revision_casos.id_revision;
          public          postgres    false    265            �            1259    17374 	   tbl_sedes    TABLE       CREATE TABLE public.tbl_sedes (
    id_sede integer NOT NULL,
    fk_departamento integer NOT NULL,
    fk_municipio integer NOT NULL,
    ubicacion character varying(60) NOT NULL,
    cod_alfabetico character varying(4),
    cod_numerico character varying(4)
);
    DROP TABLE public.tbl_sedes;
       public         heap    postgres    false    4            �            1259    17377    tbl_sedes_id_sede_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_sedes_id_sede_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.tbl_sedes_id_sede_seq;
       public          postgres    false    4    250            %           0    0    tbl_sedes_id_sede_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.tbl_sedes_id_sede_seq OWNED BY public.tbl_sedes.id_sede;
          public          postgres    false    251            �            1259    17378    tbl_sexo    TABLE     h   CREATE TABLE public.tbl_sexo (
    id_sexo integer NOT NULL,
    nom_sexo character varying NOT NULL
);
    DROP TABLE public.tbl_sexo;
       public         heap    postgres    false    4            �            1259    17383    tbl_sexo_id_sexo_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_sexo_id_sexo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.tbl_sexo_id_sexo_seq;
       public          postgres    false    4    252            &           0    0    tbl_sexo_id_sexo_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.tbl_sexo_id_sexo_seq OWNED BY public.tbl_sexo.id_sexo;
          public          postgres    false    253            �            1259    17384    tbl_usu    TABLE     A  CREATE TABLE public.tbl_usu (
    id_usu integer NOT NULL,
    usuario character varying(50),
    nombre character varying(50) NOT NULL,
    apellido character varying(50) NOT NULL,
    correo character varying(50) NOT NULL,
    contrasena character varying(100),
    telefono integer,
    num_colegiacion character varying(20),
    num_empleado character varying(20) NOT NULL,
    estado integer NOT NULL,
    jornada integer NOT NULL,
    puesto integer NOT NULL,
    sede integer NOT NULL,
    laboratorio integer,
    registro_borrado character(1),
    intentos integer
);
    DROP TABLE public.tbl_usu;
       public         heap    postgres    false    4            �            1259    17387    tbl_usu_id_usu_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_usu_id_usu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tbl_usu_id_usu_seq;
       public          postgres    false    4    254            '           0    0    tbl_usu_id_usu_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tbl_usu_id_usu_seq OWNED BY public.tbl_usu.id_usu;
          public          postgres    false    255                       1259    25632    tbl_vacaciones    TABLE     �   CREATE TABLE public.tbl_vacaciones (
    id_vacaciones integer NOT NULL,
    id_usu integer,
    fecha_inicio date,
    fecha_final date,
    dias_vacaciones integer,
    observaciones character varying(100),
    registro_borrado character(1)
);
 "   DROP TABLE public.tbl_vacaciones;
       public         heap    postgres    false    4                       1259    25631     tbl_vacaciones_id_vacaciones_seq    SEQUENCE     �   CREATE SEQUENCE public.tbl_vacaciones_id_vacaciones_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.tbl_vacaciones_id_vacaciones_seq;
       public          postgres    false    4    272            (           0    0     tbl_vacaciones_id_vacaciones_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.tbl_vacaciones_id_vacaciones_seq OWNED BY public.tbl_vacaciones.id_vacaciones;
          public          postgres    false    271            �           2604    25881    tbl_agresor id_agresor    DEFAULT     �   ALTER TABLE ONLY public.tbl_agresor ALTER COLUMN id_agresor SET DEFAULT nextval('public.tbl_agresor_id_agresor_seq'::regclass);
 E   ALTER TABLE public.tbl_agresor ALTER COLUMN id_agresor DROP DEFAULT;
       public          postgres    false    217    216            �           2604    25882    tbl_bitacora id_bitacora    DEFAULT     �   ALTER TABLE ONLY public.tbl_bitacora ALTER COLUMN id_bitacora SET DEFAULT nextval('public.tbl_bitacora_id_bitacora_seq'::regclass);
 G   ALTER TABLE public.tbl_bitacora ALTER COLUMN id_bitacora DROP DEFAULT;
       public          postgres    false    276    275    276            �           2604    25883    tbl_citaciones id_citacion    DEFAULT     �   ALTER TABLE ONLY public.tbl_citaciones ALTER COLUMN id_citacion SET DEFAULT nextval('public.tbl_citaciones_id_citacion_seq'::regclass);
 I   ALTER TABLE public.tbl_citaciones ALTER COLUMN id_citacion DROP DEFAULT;
       public          postgres    false    263    218            �           2604    25884    tbl_correlativo_caso id    DEFAULT     �   ALTER TABLE ONLY public.tbl_correlativo_caso ALTER COLUMN id SET DEFAULT nextval('public.tbl_correlativo_caso_id_seq'::regclass);
 F   ALTER TABLE public.tbl_correlativo_caso ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    262    261    262            �           2604    25885    tbl_correlativos_solicitud id    DEFAULT     �   ALTER TABLE ONLY public.tbl_correlativos_solicitud ALTER COLUMN id SET DEFAULT nextval('public.tbl_correlativos_solicitud_id_seq'::regclass);
 L   ALTER TABLE public.tbl_correlativos_solicitud ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    259    260    260            �           2604    25886     tbl_departamento id_departamento    DEFAULT     �   ALTER TABLE ONLY public.tbl_departamento ALTER COLUMN id_departamento SET DEFAULT nextval('public.tbl_departamento_id_departamento_seq'::regclass);
 O   ALTER TABLE public.tbl_departamento ALTER COLUMN id_departamento DROP DEFAULT;
       public          postgres    false    220    219            �           2604    25887    tbl_dependencia id_dependencia    DEFAULT     �   ALTER TABLE ONLY public.tbl_dependencia ALTER COLUMN id_dependencia SET DEFAULT nextval('public.tbl_dependencia_id_dependencia_seq'::regclass);
 M   ALTER TABLE public.tbl_dependencia ALTER COLUMN id_dependencia DROP DEFAULT;
       public          postgres    false    222    221            �           2604    25888    tbl_dictamen_transcripcion id    DEFAULT     �   ALTER TABLE ONLY public.tbl_dictamen_transcripcion ALTER COLUMN id SET DEFAULT nextval('public.tbl_dictamen_transcripcion_id_seq'::regclass);
 L   ALTER TABLE public.tbl_dictamen_transcripcion ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    277    278    278            �           2604    25889    tbl_dictamenes id_dictamen    DEFAULT     �   ALTER TABLE ONLY public.tbl_dictamenes ALTER COLUMN id_dictamen SET DEFAULT nextval('public.tbl_dictamenes_id_dictamen_seq'::regclass);
 I   ALTER TABLE public.tbl_dictamenes ALTER COLUMN id_dictamen DROP DEFAULT;
       public          postgres    false    264    223            �           2604    25890    tbl_escolaridad id_escolaridad    DEFAULT     �   ALTER TABLE ONLY public.tbl_escolaridad ALTER COLUMN id_escolaridad SET DEFAULT nextval('public.tbl_escolaridad_id_escolaridad_seq'::regclass);
 M   ALTER TABLE public.tbl_escolaridad ALTER COLUMN id_escolaridad DROP DEFAULT;
       public          postgres    false    225    224            �           2604    25891     tbl_estado_civil id_estado_civil    DEFAULT     �   ALTER TABLE ONLY public.tbl_estado_civil ALTER COLUMN id_estado_civil SET DEFAULT nextval('public.tbl_estado_civil_id_estado_civil_seq'::regclass);
 O   ALTER TABLE public.tbl_estado_civil ALTER COLUMN id_estado_civil DROP DEFAULT;
       public          postgres    false    227    226            �           2604    25892    tbl_estados id_estado    DEFAULT     ~   ALTER TABLE ONLY public.tbl_estados ALTER COLUMN id_estado SET DEFAULT nextval('public.tbl_estados_id_estado_seq'::regclass);
 D   ALTER TABLE public.tbl_estados ALTER COLUMN id_estado DROP DEFAULT;
       public          postgres    false    229    228            �           2604    25893    tbl_evaluado id_evaluado    DEFAULT     �   ALTER TABLE ONLY public.tbl_evaluado ALTER COLUMN id_evaluado SET DEFAULT nextval('public.tbl_evaluado_id_evaluado_seq'::regclass);
 G   ALTER TABLE public.tbl_evaluado ALTER COLUMN id_evaluado DROP DEFAULT;
       public          postgres    false    232    231            �           2604    25894    tbl_instrumento id_instrumento    DEFAULT     �   ALTER TABLE ONLY public.tbl_instrumento ALTER COLUMN id_instrumento SET DEFAULT nextval('public.tbl_instrumento_id_instrumento_seq'::regclass);
 M   ALTER TABLE public.tbl_instrumento ALTER COLUMN id_instrumento DROP DEFAULT;
       public          postgres    false    235    234            �           2604    25895    tbl_jornada id_jornada    DEFAULT     �   ALTER TABLE ONLY public.tbl_jornada ALTER COLUMN id_jornada SET DEFAULT nextval('public.tbl_jornada_id_jornada_seq'::regclass);
 E   ALTER TABLE public.tbl_jornada ALTER COLUMN id_jornada DROP DEFAULT;
       public          postgres    false    237    236            �           2604    25896    tbl_modulos id    DEFAULT     p   ALTER TABLE ONLY public.tbl_modulos ALTER COLUMN id SET DEFAULT nextval('public.tbl_modulos_id_seq'::regclass);
 =   ALTER TABLE public.tbl_modulos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    267    268    268            �           2604    25897    tbl_municipio id_municipio    DEFAULT     �   ALTER TABLE ONLY public.tbl_municipio ALTER COLUMN id_municipio SET DEFAULT nextval('public.tbl_municipio_id_municipio_seq'::regclass);
 I   ALTER TABLE public.tbl_municipio ALTER COLUMN id_municipio DROP DEFAULT;
       public          postgres    false    239    238            �           2604    25898     tbl_nacionalidad id_nacionalidad    DEFAULT     �   ALTER TABLE ONLY public.tbl_nacionalidad ALTER COLUMN id_nacionalidad SET DEFAULT nextval('public.tbl_nacionalidad_id_nacionalidad_seq'::regclass);
 O   ALTER TABLE public.tbl_nacionalidad ALTER COLUMN id_nacionalidad DROP DEFAULT;
       public          postgres    false    241    240            �           2604    25899    tbl_ocupaciones id_ocupacion    DEFAULT     �   ALTER TABLE ONLY public.tbl_ocupaciones ALTER COLUMN id_ocupacion SET DEFAULT nextval('public.tbl_ocupaciones_id_ocupacion_seq'::regclass);
 K   ALTER TABLE public.tbl_ocupaciones ALTER COLUMN id_ocupacion DROP DEFAULT;
       public          postgres    false    243    242            �           2604    25900    tbl_permisos id    DEFAULT     r   ALTER TABLE ONLY public.tbl_permisos ALTER COLUMN id SET DEFAULT nextval('public.tbl_permisos_id_seq'::regclass);
 >   ALTER TABLE public.tbl_permisos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    270    269    270            �           2604    25901    tbl_plantillas id_archivo    DEFAULT     �   ALTER TABLE ONLY public.tbl_plantillas ALTER COLUMN id_archivo SET DEFAULT nextval('public.tbl_plantillas_id_archivo_seq'::regclass);
 H   ALTER TABLE public.tbl_plantillas ALTER COLUMN id_archivo DROP DEFAULT;
       public          postgres    false    274    273    274            �           2604    25902 6   tbl_proveido_reconocimiento id_proveido_reconocimiento    DEFAULT     �   ALTER TABLE ONLY public.tbl_proveido_reconocimiento ALTER COLUMN id_proveido_reconocimiento SET DEFAULT nextval('public.tbl_proveido_reconocimiento_id_proveido_reconocimiento_seq'::regclass);
 e   ALTER TABLE public.tbl_proveido_reconocimiento ALTER COLUMN id_proveido_reconocimiento DROP DEFAULT;
       public          postgres    false    256    257    257            �           2604    25903    tbl_proveidos id_proveidos    DEFAULT     �   ALTER TABLE ONLY public.tbl_proveidos ALTER COLUMN id_proveidos SET DEFAULT nextval('public.tbl_proveidos_id_proveidos_seq'::regclass);
 I   ALTER TABLE public.tbl_proveidos ALTER COLUMN id_proveidos DROP DEFAULT;
       public          postgres    false    245    244            �           2604    25904    tbl_puestos id_puesto    DEFAULT     ~   ALTER TABLE ONLY public.tbl_puestos ALTER COLUMN id_puesto SET DEFAULT nextval('public.tbl_puestos_id_puesto_seq'::regclass);
 D   ALTER TABLE public.tbl_puestos ALTER COLUMN id_puesto DROP DEFAULT;
       public          postgres    false    247    246            �           2604    25905 $   tbl_reconocimiento id_reconocimiento    DEFAULT     �   ALTER TABLE ONLY public.tbl_reconocimiento ALTER COLUMN id_reconocimiento SET DEFAULT nextval('public.tbl_reconocimiento_id_reconocimiento_seq'::regclass);
 S   ALTER TABLE public.tbl_reconocimiento ALTER COLUMN id_reconocimiento DROP DEFAULT;
       public          postgres    false    249    248            �           2604    25906    tbl_revision_casos id_revision    DEFAULT     �   ALTER TABLE ONLY public.tbl_revision_casos ALTER COLUMN id_revision SET DEFAULT nextval('public.tbl_revision_casos_id_revision_seq'::regclass);
 M   ALTER TABLE public.tbl_revision_casos ALTER COLUMN id_revision DROP DEFAULT;
       public          postgres    false    265    266    266            �           2604    25907    tbl_sedes id_sede    DEFAULT     v   ALTER TABLE ONLY public.tbl_sedes ALTER COLUMN id_sede SET DEFAULT nextval('public.tbl_sedes_id_sede_seq'::regclass);
 @   ALTER TABLE public.tbl_sedes ALTER COLUMN id_sede DROP DEFAULT;
       public          postgres    false    251    250            �           2604    25908    tbl_sexo id_sexo    DEFAULT     t   ALTER TABLE ONLY public.tbl_sexo ALTER COLUMN id_sexo SET DEFAULT nextval('public.tbl_sexo_id_sexo_seq'::regclass);
 ?   ALTER TABLE public.tbl_sexo ALTER COLUMN id_sexo DROP DEFAULT;
       public          postgres    false    253    252            �           2604    25909    tbl_usu id_usu    DEFAULT     p   ALTER TABLE ONLY public.tbl_usu ALTER COLUMN id_usu SET DEFAULT nextval('public.tbl_usu_id_usu_seq'::regclass);
 =   ALTER TABLE public.tbl_usu ALTER COLUMN id_usu DROP DEFAULT;
       public          postgres    false    255    254            �           2604    25910    tbl_vacaciones id_vacaciones    DEFAULT     �   ALTER TABLE ONLY public.tbl_vacaciones ALTER COLUMN id_vacaciones SET DEFAULT nextval('public.tbl_vacaciones_id_vacaciones_seq'::regclass);
 K   ALTER TABLE public.tbl_vacaciones ALTER COLUMN id_vacaciones DROP DEFAULT;
       public          postgres    false    271    272    272            �          0    17292    tbl_agresor 
   TABLE DATA           >   COPY public.tbl_agresor (id_agresor, nom_agresor) FROM stdin;
    public          postgres    false    216   �U      �          0    25684    tbl_bitacora 
   TABLE DATA           m   COPY public.tbl_bitacora (id_bitacora, id_usuario, id_modulo, accion, descripcion, fecha_accion) FROM stdin;
    public          postgres    false    276   �U      �          0    17296    tbl_citaciones 
   TABLE DATA           �   COPY public.tbl_citaciones (numero_caso, tipo_citacion, fecha_recep_citacion, fecha_citacion, medico, lugar_citacion, id_citacion, registro_borrado) FROM stdin;
    public          postgres    false    218   
V      �          0    25499    tbl_clinicas 
   TABLE DATA           ^   COPY public.tbl_clinicas (id_clinica, nombre, codigo_alfabetico, codigo_numerico) FROM stdin;
    public          postgres    false    258   'V      �          0    25542    tbl_correlativo_caso 
   TABLE DATA           R   COPY public.tbl_correlativo_caso (id, sede, ultimo_correlativo, anio) FROM stdin;
    public          postgres    false    262   �V      �          0    25525    tbl_correlativos_solicitud 
   TABLE DATA           e   COPY public.tbl_correlativos_solicitud (id, sede, laboratorio, ultimo_correlativo, anio) FROM stdin;
    public          postgres    false    260   �V      �          0    17299    tbl_departamento 
   TABLE DATA           P   COPY public.tbl_departamento (id_departamento, nombre_departamento) FROM stdin;
    public          postgres    false    219   W      �          0    17303    tbl_dependencia 
   TABLE DATA           \   COPY public.tbl_dependencia (id_dependencia, nom_dependencia, registro_borrado) FROM stdin;
    public          postgres    false    221   �W                0    25874    tbl_dictamen_transcripcion 
   TABLE DATA           �   COPY public.tbl_dictamen_transcripcion (id, id_dictamen, medico, fecha_evaluacion, autoridad_solicitante, fecha_entrega, datos_extra, registro_borrado, tipo_documento) FROM stdin;
    public          postgres    false    278   rX      �          0    17307    tbl_dictamenes 
   TABLE DATA           �   COPY public.tbl_dictamenes (numero_caso, medico, fecha_evaluacion, autoridad_solicitante, fecha_entrega, datos_extra, id_dictamen, registro_borrado) FROM stdin;
    public          postgres    false    223   �X      �          0    17310    tbl_escolaridad 
   TABLE DATA           J   COPY public.tbl_escolaridad (id_escolaridad, nom_escolaridad) FROM stdin;
    public          postgres    false    224   �X      �          0    17314    tbl_estado_civil 
   TABLE DATA           G   COPY public.tbl_estado_civil (id_estado_civil, nom_estado) FROM stdin;
    public          postgres    false    226   Y      �          0    17320    tbl_estados 
   TABLE DATA           <   COPY public.tbl_estados (id_estado, nom_estado) FROM stdin;
    public          postgres    false    228   yY      �          0    17326    tbl_evaluacion 
   TABLE DATA           �   COPY public.tbl_evaluacion (consentimiento_informado, instrumento_agresion, descripcion_evaluacion, relacion_agresor, especificar_relacion, sede_evaluacion, fecha_finalizacion, id_proveido) FROM stdin;
    public          postgres    false    230   �Y      �          0    17329    tbl_evaluado 
   TABLE DATA           S  COPY public.tbl_evaluado (id_evaluado, nombre_evaluado, apellido_evaluado, dni_evaluado, telefono_evaluado, id_sexo, edad, diversidad, tiempo, nombre_acompanante, apellido_acompanante, relacion_acompanante, id_proveido, estado_evaluacion, nacionalidad, estado_civil, ocupacion, lugar_procedencia, escolaridad, dni_acompanante) FROM stdin;
    public          postgres    false    231   �Y      �          0    17333 	   tbl_hecho 
   TABLE DATA           t   COPY public.tbl_hecho (id_departamento, id_municipio, localidad, lugar_hecho, fecha_hecho, id_proveido) FROM stdin;
    public          postgres    false    233   Z      �          0    17336    tbl_instrumento 
   TABLE DATA           J   COPY public.tbl_instrumento (id_instrumento, nom_instrumento) FROM stdin;
    public          postgres    false    234   2Z      �          0    17340    tbl_jornada 
   TABLE DATA           >   COPY public.tbl_jornada (id_jornada, nom_jornada) FROM stdin;
    public          postgres    false    236   OZ      �          0    25618    tbl_modulos 
   TABLE DATA           �   COPY public.tbl_modulos (id, nombre, fecha_creacion, creado_por, fecha_modificacion, registro_borrado, descripcion, modificado_por) FROM stdin;
    public          postgres    false    268   �Z      �          0    17346    tbl_municipio 
   TABLE DATA           X   COPY public.tbl_municipio (id_municipio, nombre_municipio, id_departamento) FROM stdin;
    public          postgres    false    238   ]\      �          0    17350    tbl_nacionalidad 
   TABLE DATA           M   COPY public.tbl_nacionalidad (id_nacionalidad, nom_nacionalidad) FROM stdin;
    public          postgres    false    240   �e      �          0    17354    tbl_ocupaciones 
   TABLE DATA           F   COPY public.tbl_ocupaciones (id_ocupacion, nom_ocupacion) FROM stdin;
    public          postgres    false    242   �e      �          0    25625    tbl_permisos 
   TABLE DATA           �   COPY public.tbl_permisos (id, id_modulo, id_puesto, consulta, insercion, actualizacion, eliminacion, registro_borrado) FROM stdin;
    public          postgres    false    270   �e      �          0    25671    tbl_plantillas 
   TABLE DATA           B   COPY public.tbl_plantillas (id_archivo, ruta_archivo) FROM stdin;
    public          postgres    false    274   �f      �          0    25493    tbl_proveido_reconocimiento 
   TABLE DATA           ~   COPY public.tbl_proveido_reconocimiento (id_proveido_reconocimiento, tipo_reconocimiento, medico, fecha_citacion) FROM stdin;
    public          postgres    false    257   �j      �          0    17358    tbl_proveidos 
   TABLE DATA           �   COPY public.tbl_proveidos (id_proveidos, num_caso, num_caso_ext, fech_emi_soli, fech_recep_soli, fiscalia_remitente, registro_borrado, num_solicitud, especifique_cual) FROM stdin;
    public          postgres    false    244   
k      �          0    17362    tbl_puestos 
   TABLE DATA           D   COPY public.tbl_puestos (id_puesto, nom_puesto, estado) FROM stdin;
    public          postgres    false    246   'k      �          0    17366    tbl_reconocimiento 
   TABLE DATA           S   COPY public.tbl_reconocimiento (id_reconocimiento, nom_reconocimiento) FROM stdin;
    public          postgres    false    248   �k      �          0    25609    tbl_revision_casos 
   TABLE DATA             COPY public.tbl_revision_casos (id_revision, medico, enviado_para, fecha_revision, tipo_dictamen, numero_dictamen, nombre_evaluado, fecha_evaluacion, tipo_reconocimiento, obs_reconocimiento, estado_dictamen, obs_dictamen, sede_medico, sede_clinica, registro_borrado) FROM stdin;
    public          postgres    false    266   l      �          0    17374 	   tbl_sedes 
   TABLE DATA           t   COPY public.tbl_sedes (id_sede, fk_departamento, fk_municipio, ubicacion, cod_alfabetico, cod_numerico) FROM stdin;
    public          postgres    false    250   2l      �          0    17378    tbl_sexo 
   TABLE DATA           5   COPY public.tbl_sexo (id_sexo, nom_sexo) FROM stdin;
    public          postgres    false    252   ;n      �          0    17384    tbl_usu 
   TABLE DATA           �   COPY public.tbl_usu (id_usu, usuario, nombre, apellido, correo, contrasena, telefono, num_colegiacion, num_empleado, estado, jornada, puesto, sede, laboratorio, registro_borrado, intentos) FROM stdin;
    public          postgres    false    254   |n      �          0    25632    tbl_vacaciones 
   TABLE DATA           �   COPY public.tbl_vacaciones (id_vacaciones, id_usu, fecha_inicio, fecha_final, dias_vacaciones, observaciones, registro_borrado) FROM stdin;
    public          postgres    false    272   o      )           0    0    tbl_agresor_id_agresor_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.tbl_agresor_id_agresor_seq', 1, false);
          public          postgres    false    217            *           0    0    tbl_bitacora_id_bitacora_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.tbl_bitacora_id_bitacora_seq', 511, true);
          public          postgres    false    275            +           0    0    tbl_citaciones_id_citacion_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tbl_citaciones_id_citacion_seq', 23, true);
          public          postgres    false    263            ,           0    0    tbl_correlativo_caso_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.tbl_correlativo_caso_id_seq', 16, true);
          public          postgres    false    261            -           0    0 !   tbl_correlativos_solicitud_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.tbl_correlativos_solicitud_id_seq', 26, true);
          public          postgres    false    259            .           0    0 $   tbl_departamento_id_departamento_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.tbl_departamento_id_departamento_seq', 18, true);
          public          postgres    false    220            /           0    0 "   tbl_dependencia_id_dependencia_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.tbl_dependencia_id_dependencia_seq', 7, true);
          public          postgres    false    222            0           0    0 !   tbl_dictamen_transcripcion_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.tbl_dictamen_transcripcion_id_seq', 15, true);
          public          postgres    false    277            1           0    0    tbl_dictamenes_id_dictamen_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tbl_dictamenes_id_dictamen_seq', 21, true);
          public          postgres    false    264            2           0    0 "   tbl_escolaridad_id_escolaridad_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.tbl_escolaridad_id_escolaridad_seq', 8, true);
          public          postgres    false    225            3           0    0 $   tbl_estado_civil_id_estado_civil_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public.tbl_estado_civil_id_estado_civil_seq', 6, true);
          public          postgres    false    227            4           0    0    tbl_estados_id_estado_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.tbl_estados_id_estado_seq', 7, true);
          public          postgres    false    229            5           0    0    tbl_evaluado_id_evaluado_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.tbl_evaluado_id_evaluado_seq', 57, true);
          public          postgres    false    232            6           0    0 "   tbl_instrumento_id_instrumento_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.tbl_instrumento_id_instrumento_seq', 23, true);
          public          postgres    false    235            7           0    0    tbl_jornada_id_jornada_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tbl_jornada_id_jornada_seq', 3, true);
          public          postgres    false    237            8           0    0    tbl_modulos_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.tbl_modulos_id_seq', 26, true);
          public          postgres    false    267            9           0    0    tbl_municipio_id_municipio_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tbl_municipio_id_municipio_seq', 1136, true);
          public          postgres    false    239            :           0    0 $   tbl_nacionalidad_id_nacionalidad_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.tbl_nacionalidad_id_nacionalidad_seq', 12, true);
          public          postgres    false    241            ;           0    0     tbl_ocupaciones_id_ocupacion_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tbl_ocupaciones_id_ocupacion_seq', 25, true);
          public          postgres    false    243            <           0    0    tbl_permisos_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.tbl_permisos_id_seq', 93, true);
          public          postgres    false    269            =           0    0    tbl_plantillas_id_archivo_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.tbl_plantillas_id_archivo_seq', 34, true);
          public          postgres    false    273            >           0    0 :   tbl_proveido_reconocimiento_id_proveido_reconocimiento_seq    SEQUENCE SET     i   SELECT pg_catalog.setval('public.tbl_proveido_reconocimiento_id_proveido_reconocimiento_seq', 1, false);
          public          postgres    false    256            ?           0    0    tbl_proveidos_id_proveidos_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.tbl_proveidos_id_proveidos_seq', 66, true);
          public          postgres    false    245            @           0    0    tbl_puestos_id_puesto_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tbl_puestos_id_puesto_seq', 11, true);
          public          postgres    false    247            A           0    0 (   tbl_reconocimiento_id_reconocimiento_seq    SEQUENCE SET     V   SELECT pg_catalog.setval('public.tbl_reconocimiento_id_reconocimiento_seq', 8, true);
          public          postgres    false    249            B           0    0 "   tbl_revision_casos_id_revision_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.tbl_revision_casos_id_revision_seq', 9, true);
          public          postgres    false    265            C           0    0    tbl_sedes_id_sede_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.tbl_sedes_id_sede_seq', 29, true);
          public          postgres    false    251            D           0    0    tbl_sexo_id_sexo_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.tbl_sexo_id_sexo_seq', 13, true);
          public          postgres    false    253            E           0    0    tbl_usu_id_usu_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.tbl_usu_id_usu_seq', 23, true);
          public          postgres    false    255            F           0    0     tbl_vacaciones_id_vacaciones_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tbl_vacaciones_id_vacaciones_seq', 12, true);
          public          postgres    false    271            �           2606    17408    tbl_estados estados_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tbl_estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id_estado);
 B   ALTER TABLE ONLY public.tbl_estados DROP CONSTRAINT estados_pkey;
       public            postgres    false    228                       2606    25689    tbl_bitacora tbl_bitacora_pk 
   CONSTRAINT     c   ALTER TABLE ONLY public.tbl_bitacora
    ADD CONSTRAINT tbl_bitacora_pk PRIMARY KEY (id_bitacora);
 F   ALTER TABLE ONLY public.tbl_bitacora DROP CONSTRAINT tbl_bitacora_pk;
       public            postgres    false    276            �           2606    25580     tbl_citaciones tbl_citaciones_pk 
   CONSTRAINT     g   ALTER TABLE ONLY public.tbl_citaciones
    ADD CONSTRAINT tbl_citaciones_pk PRIMARY KEY (id_citacion);
 J   ALTER TABLE ONLY public.tbl_citaciones DROP CONSTRAINT tbl_citaciones_pk;
       public            postgres    false    218            �           2606    25512    tbl_clinicas tbl_clinicas_pk 
   CONSTRAINT     b   ALTER TABLE ONLY public.tbl_clinicas
    ADD CONSTRAINT tbl_clinicas_pk PRIMARY KEY (id_clinica);
 F   ALTER TABLE ONLY public.tbl_clinicas DROP CONSTRAINT tbl_clinicas_pk;
       public            postgres    false    258                       2606    25547 ,   tbl_correlativo_caso tbl_correlativo_caso_pk 
   CONSTRAINT     j   ALTER TABLE ONLY public.tbl_correlativo_caso
    ADD CONSTRAINT tbl_correlativo_caso_pk PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.tbl_correlativo_caso DROP CONSTRAINT tbl_correlativo_caso_pk;
       public            postgres    false    262                       2606    25530 :   tbl_correlativos_solicitud tbl_correlativos_solicitud_pkey 
   CONSTRAINT     x   ALTER TABLE ONLY public.tbl_correlativos_solicitud
    ADD CONSTRAINT tbl_correlativos_solicitud_pkey PRIMARY KEY (id);
 d   ALTER TABLE ONLY public.tbl_correlativos_solicitud DROP CONSTRAINT tbl_correlativos_solicitud_pkey;
       public            postgres    false    260            �           2606    17412 &   tbl_departamento tbl_departamento_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_departamento
    ADD CONSTRAINT tbl_departamento_pkey PRIMARY KEY (id_departamento);
 P   ALTER TABLE ONLY public.tbl_departamento DROP CONSTRAINT tbl_departamento_pkey;
       public            postgres    false    219            �           2606    17414 $   tbl_dependencia tbl_dependencia_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_dependencia
    ADD CONSTRAINT tbl_dependencia_pkey PRIMARY KEY (id_dependencia);
 N   ALTER TABLE ONLY public.tbl_dependencia DROP CONSTRAINT tbl_dependencia_pkey;
       public            postgres    false    221                       2606    25879 8   tbl_dictamen_transcripcion tbl_dictamen_transcripcion_pk 
   CONSTRAINT     v   ALTER TABLE ONLY public.tbl_dictamen_transcripcion
    ADD CONSTRAINT tbl_dictamen_transcripcion_pk PRIMARY KEY (id);
 b   ALTER TABLE ONLY public.tbl_dictamen_transcripcion DROP CONSTRAINT tbl_dictamen_transcripcion_pk;
       public            postgres    false    278            �           2606    25587     tbl_dictamenes tbl_dictamenes_pk 
   CONSTRAINT     g   ALTER TABLE ONLY public.tbl_dictamenes
    ADD CONSTRAINT tbl_dictamenes_pk PRIMARY KEY (id_dictamen);
 J   ALTER TABLE ONLY public.tbl_dictamenes DROP CONSTRAINT tbl_dictamenes_pk;
       public            postgres    false    223            �           2606    17416 $   tbl_escolaridad tbl_escolaridad_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_escolaridad
    ADD CONSTRAINT tbl_escolaridad_pkey PRIMARY KEY (id_escolaridad);
 N   ALTER TABLE ONLY public.tbl_escolaridad DROP CONSTRAINT tbl_escolaridad_pkey;
       public            postgres    false    224            �           2606    17418 &   tbl_estado_civil tbl_estado_civil_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_estado_civil
    ADD CONSTRAINT tbl_estado_civil_pkey PRIMARY KEY (id_estado_civil);
 P   ALTER TABLE ONLY public.tbl_estado_civil DROP CONSTRAINT tbl_estado_civil_pkey;
       public            postgres    false    226            �           2606    17420    tbl_evaluado tbl_evaluado_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT tbl_evaluado_pkey PRIMARY KEY (id_evaluado);
 H   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT tbl_evaluado_pkey;
       public            postgres    false    231            �           2606    17422 $   tbl_instrumento tbl_instrumento_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tbl_instrumento
    ADD CONSTRAINT tbl_instrumento_pkey PRIMARY KEY (id_instrumento);
 N   ALTER TABLE ONLY public.tbl_instrumento DROP CONSTRAINT tbl_instrumento_pkey;
       public            postgres    false    234            �           2606    17424    tbl_jornada tbl_jornada_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tbl_jornada
    ADD CONSTRAINT tbl_jornada_pkey PRIMARY KEY (id_jornada);
 F   ALTER TABLE ONLY public.tbl_jornada DROP CONSTRAINT tbl_jornada_pkey;
       public            postgres    false    236                       2606    25623    tbl_modulos tbl_modulos_pk 
   CONSTRAINT     X   ALTER TABLE ONLY public.tbl_modulos
    ADD CONSTRAINT tbl_modulos_pk PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.tbl_modulos DROP CONSTRAINT tbl_modulos_pk;
       public            postgres    false    268            �           2606    17426     tbl_municipio tbl_municipio_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tbl_municipio
    ADD CONSTRAINT tbl_municipio_pkey PRIMARY KEY (id_municipio);
 J   ALTER TABLE ONLY public.tbl_municipio DROP CONSTRAINT tbl_municipio_pkey;
       public            postgres    false    238            �           2606    17428 &   tbl_nacionalidad tbl_nacionalidad_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tbl_nacionalidad
    ADD CONSTRAINT tbl_nacionalidad_pkey PRIMARY KEY (id_nacionalidad);
 P   ALTER TABLE ONLY public.tbl_nacionalidad DROP CONSTRAINT tbl_nacionalidad_pkey;
       public            postgres    false    240            �           2606    17430 $   tbl_ocupaciones tbl_ocupaciones_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.tbl_ocupaciones
    ADD CONSTRAINT tbl_ocupaciones_pkey PRIMARY KEY (id_ocupacion);
 N   ALTER TABLE ONLY public.tbl_ocupaciones DROP CONSTRAINT tbl_ocupaciones_pkey;
       public            postgres    false    242            	           2606    25630    tbl_permisos tbl_permisos_pk 
   CONSTRAINT     Z   ALTER TABLE ONLY public.tbl_permisos
    ADD CONSTRAINT tbl_permisos_pk PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.tbl_permisos DROP CONSTRAINT tbl_permisos_pk;
       public            postgres    false    270                       2606    25678     tbl_plantillas tbl_plantillas_pk 
   CONSTRAINT     f   ALTER TABLE ONLY public.tbl_plantillas
    ADD CONSTRAINT tbl_plantillas_pk PRIMARY KEY (id_archivo);
 J   ALTER TABLE ONLY public.tbl_plantillas DROP CONSTRAINT tbl_plantillas_pk;
       public            postgres    false    274            �           2606    25498 :   tbl_proveido_reconocimiento tbl_proveido_reconocimiento_pk 
   CONSTRAINT     �   ALTER TABLE ONLY public.tbl_proveido_reconocimiento
    ADD CONSTRAINT tbl_proveido_reconocimiento_pk PRIMARY KEY (id_proveido_reconocimiento);
 d   ALTER TABLE ONLY public.tbl_proveido_reconocimiento DROP CONSTRAINT tbl_proveido_reconocimiento_pk;
       public            postgres    false    257            �           2606    17432     tbl_proveidos tbl_proveidos_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tbl_proveidos
    ADD CONSTRAINT tbl_proveidos_pkey PRIMARY KEY (id_proveidos);
 J   ALTER TABLE ONLY public.tbl_proveidos DROP CONSTRAINT tbl_proveidos_pkey;
       public            postgres    false    244            �           2606    17434    tbl_puestos tbl_puestos_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.tbl_puestos
    ADD CONSTRAINT tbl_puestos_pkey PRIMARY KEY (id_puesto);
 F   ALTER TABLE ONLY public.tbl_puestos DROP CONSTRAINT tbl_puestos_pkey;
       public            postgres    false    246            �           2606    17436 *   tbl_reconocimiento tbl_reconocimiento_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY public.tbl_reconocimiento
    ADD CONSTRAINT tbl_reconocimiento_pkey PRIMARY KEY (id_reconocimiento);
 T   ALTER TABLE ONLY public.tbl_reconocimiento DROP CONSTRAINT tbl_reconocimiento_pkey;
       public            postgres    false    248                       2606    25616 (   tbl_revision_casos tbl_revision_casos_pk 
   CONSTRAINT     o   ALTER TABLE ONLY public.tbl_revision_casos
    ADD CONSTRAINT tbl_revision_casos_pk PRIMARY KEY (id_revision);
 R   ALTER TABLE ONLY public.tbl_revision_casos DROP CONSTRAINT tbl_revision_casos_pk;
       public            postgres    false    266            �           2606    17438    tbl_sedes tbl_sedes_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.tbl_sedes
    ADD CONSTRAINT tbl_sedes_pkey PRIMARY KEY (id_sede);
 B   ALTER TABLE ONLY public.tbl_sedes DROP CONSTRAINT tbl_sedes_pkey;
       public            postgres    false    250            �           2606    17440    tbl_sexo tbl_sexo_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.tbl_sexo
    ADD CONSTRAINT tbl_sexo_pkey PRIMARY KEY (id_sexo);
 @   ALTER TABLE ONLY public.tbl_sexo DROP CONSTRAINT tbl_sexo_pkey;
       public            postgres    false    252            �           2606    17442    tbl_usu tbl_usu_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.tbl_usu
    ADD CONSTRAINT tbl_usu_pkey PRIMARY KEY (id_usu);
 >   ALTER TABLE ONLY public.tbl_usu DROP CONSTRAINT tbl_usu_pkey;
       public            postgres    false    254                       2606    25637     tbl_vacaciones tbl_vacaciones_pk 
   CONSTRAINT     i   ALTER TABLE ONLY public.tbl_vacaciones
    ADD CONSTRAINT tbl_vacaciones_pk PRIMARY KEY (id_vacaciones);
 J   ALTER TABLE ONLY public.tbl_vacaciones DROP CONSTRAINT tbl_vacaciones_pk;
       public            postgres    false    272            !           2606    17443    tbl_municipio fk_departamento    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_municipio
    ADD CONSTRAINT fk_departamento FOREIGN KEY (id_departamento) REFERENCES public.tbl_departamento(id_departamento);
 G   ALTER TABLE ONLY public.tbl_municipio DROP CONSTRAINT fk_departamento;
       public          postgres    false    219    4825    238            0           2606    34294 (   tbl_bitacora tbl_bitacora_tbl_modulos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_bitacora
    ADD CONSTRAINT tbl_bitacora_tbl_modulos_fk FOREIGN KEY (id_modulo) REFERENCES public.tbl_modulos(id);
 R   ALTER TABLE ONLY public.tbl_bitacora DROP CONSTRAINT tbl_bitacora_tbl_modulos_fk;
       public          postgres    false    276    268    4871            1           2606    34289 $   tbl_bitacora tbl_bitacora_tbl_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_bitacora
    ADD CONSTRAINT tbl_bitacora_tbl_usu_fk FOREIGN KEY (id_usuario) REFERENCES public.tbl_usu(id_usu);
 N   ALTER TABLE ONLY public.tbl_bitacora DROP CONSTRAINT tbl_bitacora_tbl_usu_fk;
       public          postgres    false    254    276    4859                       2606    34299 .   tbl_citaciones tbl_citaciones_tbl_proveidos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_citaciones
    ADD CONSTRAINT tbl_citaciones_tbl_proveidos_fk FOREIGN KEY (numero_caso) REFERENCES public.tbl_proveidos(id_proveidos);
 X   ALTER TABLE ONLY public.tbl_citaciones DROP CONSTRAINT tbl_citaciones_tbl_proveidos_fk;
       public          postgres    false    218    4849    244                       2606    34304 (   tbl_citaciones tbl_citaciones_tbl_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_citaciones
    ADD CONSTRAINT tbl_citaciones_tbl_usu_fk FOREIGN KEY (medico) REFERENCES public.tbl_usu(id_usu);
 R   ALTER TABLE ONLY public.tbl_citaciones DROP CONSTRAINT tbl_citaciones_tbl_usu_fk;
       public          postgres    false    4859    254    218            2           2606    34309 G   tbl_dictamen_transcripcion tbl_dictamen_transcripcion_tbl_dictamenes_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_dictamen_transcripcion
    ADD CONSTRAINT tbl_dictamen_transcripcion_tbl_dictamenes_fk FOREIGN KEY (id_dictamen) REFERENCES public.tbl_dictamenes(id_dictamen);
 q   ALTER TABLE ONLY public.tbl_dictamen_transcripcion DROP CONSTRAINT tbl_dictamen_transcripcion_tbl_dictamenes_fk;
       public          postgres    false    278    4829    223            3           2606    34314 @   tbl_dictamen_transcripcion tbl_dictamen_transcripcion_tbl_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_dictamen_transcripcion
    ADD CONSTRAINT tbl_dictamen_transcripcion_tbl_usu_fk FOREIGN KEY (medico) REFERENCES public.tbl_usu(id_usu);
 j   ALTER TABLE ONLY public.tbl_dictamen_transcripcion DROP CONSTRAINT tbl_dictamen_transcripcion_tbl_usu_fk;
       public          postgres    false    4859    278    254                       2606    34319 .   tbl_dictamenes tbl_dictamenes_tbl_proveidos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_dictamenes
    ADD CONSTRAINT tbl_dictamenes_tbl_proveidos_fk FOREIGN KEY (numero_caso) REFERENCES public.tbl_proveidos(id_proveidos);
 X   ALTER TABLE ONLY public.tbl_dictamenes DROP CONSTRAINT tbl_dictamenes_tbl_proveidos_fk;
       public          postgres    false    244    223    4849                       2606    34324 (   tbl_dictamenes tbl_dictamenes_tbl_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_dictamenes
    ADD CONSTRAINT tbl_dictamenes_tbl_usu_fk FOREIGN KEY (medico) REFERENCES public.tbl_usu(id_usu);
 R   ALTER TABLE ONLY public.tbl_dictamenes DROP CONSTRAINT tbl_dictamenes_tbl_usu_fk;
       public          postgres    false    223    254    4859                       2606    34329 0   tbl_evaluacion tbl_evaluacion_tbl_instrumento_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluacion
    ADD CONSTRAINT tbl_evaluacion_tbl_instrumento_fk FOREIGN KEY (instrumento_agresion) REFERENCES public.tbl_instrumento(id_instrumento);
 Z   ALTER TABLE ONLY public.tbl_evaluacion DROP CONSTRAINT tbl_evaluacion_tbl_instrumento_fk;
       public          postgres    false    4839    234    230                       2606    34339 .   tbl_evaluacion tbl_evaluacion_tbl_proveidos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluacion
    ADD CONSTRAINT tbl_evaluacion_tbl_proveidos_fk FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 X   ALTER TABLE ONLY public.tbl_evaluacion DROP CONSTRAINT tbl_evaluacion_tbl_proveidos_fk;
       public          postgres    false    4849    230    244                       2606    34334 *   tbl_evaluacion tbl_evaluacion_tbl_sedes_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluacion
    ADD CONSTRAINT tbl_evaluacion_tbl_sedes_fk FOREIGN KEY (sede_evaluacion) REFERENCES public.tbl_sedes(id_sede);
 T   ALTER TABLE ONLY public.tbl_evaluacion DROP CONSTRAINT tbl_evaluacion_tbl_sedes_fk;
       public          postgres    false    4855    250    230                       2606    34354 -   tbl_evaluado tbl_evaluado_tbl_estado_civil_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT tbl_evaluado_tbl_estado_civil_fk FOREIGN KEY (estado_civil) REFERENCES public.tbl_estado_civil(id_estado_civil);
 W   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT tbl_evaluado_tbl_estado_civil_fk;
       public          postgres    false    231    4833    226                       2606    34364 -   tbl_evaluado tbl_evaluado_tbl_nacionalidad_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT tbl_evaluado_tbl_nacionalidad_fk FOREIGN KEY (nacionalidad) REFERENCES public.tbl_nacionalidad(id_nacionalidad);
 W   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT tbl_evaluado_tbl_nacionalidad_fk;
       public          postgres    false    4845    231    240                       2606    34349 ,   tbl_evaluado tbl_evaluado_tbl_ocupaciones_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT tbl_evaluado_tbl_ocupaciones_fk FOREIGN KEY (ocupacion) REFERENCES public.tbl_ocupaciones(id_ocupacion);
 V   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT tbl_evaluado_tbl_ocupaciones_fk;
       public          postgres    false    231    4847    242                       2606    34359 *   tbl_evaluado tbl_evaluado_tbl_proveidos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT tbl_evaluado_tbl_proveidos_fk FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 T   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT tbl_evaluado_tbl_proveidos_fk;
       public          postgres    false    231    4849    244                       2606    34344 %   tbl_evaluado tbl_evaluado_tbl_sexo_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_evaluado
    ADD CONSTRAINT tbl_evaluado_tbl_sexo_fk FOREIGN KEY (id_sexo) REFERENCES public.tbl_sexo(id_sexo);
 O   ALTER TABLE ONLY public.tbl_evaluado DROP CONSTRAINT tbl_evaluado_tbl_sexo_fk;
       public          postgres    false    231    252    4857                       2606    34369 '   tbl_hecho tbl_hecho_tbl_departamento_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_hecho
    ADD CONSTRAINT tbl_hecho_tbl_departamento_fk FOREIGN KEY (id_departamento) REFERENCES public.tbl_departamento(id_departamento);
 Q   ALTER TABLE ONLY public.tbl_hecho DROP CONSTRAINT tbl_hecho_tbl_departamento_fk;
       public          postgres    false    233    219    4825                       2606    34374 $   tbl_hecho tbl_hecho_tbl_municipio_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_hecho
    ADD CONSTRAINT tbl_hecho_tbl_municipio_fk FOREIGN KEY (id_municipio) REFERENCES public.tbl_municipio(id_municipio);
 N   ALTER TABLE ONLY public.tbl_hecho DROP CONSTRAINT tbl_hecho_tbl_municipio_fk;
       public          postgres    false    4843    233    238                        2606    34379 $   tbl_hecho tbl_hecho_tbl_proveidos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_hecho
    ADD CONSTRAINT tbl_hecho_tbl_proveidos_fk FOREIGN KEY (id_proveido) REFERENCES public.tbl_proveidos(id_proveidos);
 N   ALTER TABLE ONLY public.tbl_hecho DROP CONSTRAINT tbl_hecho_tbl_proveidos_fk;
       public          postgres    false    4849    244    233            *           2606    34401 H   tbl_proveido_reconocimiento tbl_proveido_reconocimiento_tbl_proveidos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_proveido_reconocimiento
    ADD CONSTRAINT tbl_proveido_reconocimiento_tbl_proveidos_fk FOREIGN KEY (id_proveido_reconocimiento) REFERENCES public.tbl_proveidos(id_proveidos);
 r   ALTER TABLE ONLY public.tbl_proveido_reconocimiento DROP CONSTRAINT tbl_proveido_reconocimiento_tbl_proveidos_fk;
       public          postgres    false    244    4849    257            +           2606    34411 M   tbl_proveido_reconocimiento tbl_proveido_reconocimiento_tbl_reconocimiento_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_proveido_reconocimiento
    ADD CONSTRAINT tbl_proveido_reconocimiento_tbl_reconocimiento_fk FOREIGN KEY (tipo_reconocimiento) REFERENCES public.tbl_reconocimiento(id_reconocimiento);
 w   ALTER TABLE ONLY public.tbl_proveido_reconocimiento DROP CONSTRAINT tbl_proveido_reconocimiento_tbl_reconocimiento_fk;
       public          postgres    false    4853    248    257            ,           2606    34406 B   tbl_proveido_reconocimiento tbl_proveido_reconocimiento_tbl_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_proveido_reconocimiento
    ADD CONSTRAINT tbl_proveido_reconocimiento_tbl_usu_fk FOREIGN KEY (medico) REFERENCES public.tbl_usu(id_usu);
 l   ALTER TABLE ONLY public.tbl_proveido_reconocimiento DROP CONSTRAINT tbl_proveido_reconocimiento_tbl_usu_fk;
       public          postgres    false    254    257    4859            "           2606    34416 .   tbl_proveidos tbl_proveidos_tbl_dependencia_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_proveidos
    ADD CONSTRAINT tbl_proveidos_tbl_dependencia_fk FOREIGN KEY (fiscalia_remitente) REFERENCES public.tbl_dependencia(id_dependencia);
 X   ALTER TABLE ONLY public.tbl_proveidos DROP CONSTRAINT tbl_proveidos_tbl_dependencia_fk;
       public          postgres    false    4827    244    221            -           2606    34426 2   tbl_revision_casos tbl_revision_casos_tbl_sedes_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_revision_casos
    ADD CONSTRAINT tbl_revision_casos_tbl_sedes_fk FOREIGN KEY (sede_clinica) REFERENCES public.tbl_sedes(id_sede);
 \   ALTER TABLE ONLY public.tbl_revision_casos DROP CONSTRAINT tbl_revision_casos_tbl_sedes_fk;
       public          postgres    false    266    4855    250            .           2606    34421 0   tbl_revision_casos tbl_revision_casos_tbl_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_revision_casos
    ADD CONSTRAINT tbl_revision_casos_tbl_usu_fk FOREIGN KEY (medico) REFERENCES public.tbl_usu(id_usu);
 Z   ALTER TABLE ONLY public.tbl_revision_casos DROP CONSTRAINT tbl_revision_casos_tbl_usu_fk;
       public          postgres    false    266    4859    254            #           2606    25700 '   tbl_sedes tbl_sedes_tbl_departamento_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_sedes
    ADD CONSTRAINT tbl_sedes_tbl_departamento_fk FOREIGN KEY (fk_departamento) REFERENCES public.tbl_departamento(id_departamento);
 Q   ALTER TABLE ONLY public.tbl_sedes DROP CONSTRAINT tbl_sedes_tbl_departamento_fk;
       public          postgres    false    4825    250    219            $           2606    25705 $   tbl_sedes tbl_sedes_tbl_municipio_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_sedes
    ADD CONSTRAINT tbl_sedes_tbl_municipio_fk FOREIGN KEY (fk_municipio) REFERENCES public.tbl_municipio(id_municipio);
 N   ALTER TABLE ONLY public.tbl_sedes DROP CONSTRAINT tbl_sedes_tbl_municipio_fk;
       public          postgres    false    238    4843    250            %           2606    25740    tbl_usu tbl_usu_tbl_clinicas_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_usu
    ADD CONSTRAINT tbl_usu_tbl_clinicas_fk FOREIGN KEY (laboratorio) REFERENCES public.tbl_clinicas(id_clinica);
 I   ALTER TABLE ONLY public.tbl_usu DROP CONSTRAINT tbl_usu_tbl_clinicas_fk;
       public          postgres    false    4863    254    258            &           2606    25720    tbl_usu tbl_usu_tbl_estados_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_usu
    ADD CONSTRAINT tbl_usu_tbl_estados_fk FOREIGN KEY (estado) REFERENCES public.tbl_estados(id_estado);
 H   ALTER TABLE ONLY public.tbl_usu DROP CONSTRAINT tbl_usu_tbl_estados_fk;
       public          postgres    false    4835    228    254            '           2606    25725    tbl_usu tbl_usu_tbl_jornada_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_usu
    ADD CONSTRAINT tbl_usu_tbl_jornada_fk FOREIGN KEY (jornada) REFERENCES public.tbl_jornada(id_jornada);
 H   ALTER TABLE ONLY public.tbl_usu DROP CONSTRAINT tbl_usu_tbl_jornada_fk;
       public          postgres    false    4841    236    254            (           2606    25730    tbl_usu tbl_usu_tbl_puestos_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_usu
    ADD CONSTRAINT tbl_usu_tbl_puestos_fk FOREIGN KEY (puesto) REFERENCES public.tbl_puestos(id_puesto);
 H   ALTER TABLE ONLY public.tbl_usu DROP CONSTRAINT tbl_usu_tbl_puestos_fk;
       public          postgres    false    254    4851    246            )           2606    25735    tbl_usu tbl_usu_tbl_sedes_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_usu
    ADD CONSTRAINT tbl_usu_tbl_sedes_fk FOREIGN KEY (sede) REFERENCES public.tbl_sedes(id_sede);
 F   ALTER TABLE ONLY public.tbl_usu DROP CONSTRAINT tbl_usu_tbl_sedes_fk;
       public          postgres    false    4855    254    250            /           2606    34431 (   tbl_vacaciones tbl_vacaciones_tbl_usu_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.tbl_vacaciones
    ADD CONSTRAINT tbl_vacaciones_tbl_usu_fk FOREIGN KEY (id_usu) REFERENCES public.tbl_usu(id_usu);
 R   ALTER TABLE ONLY public.tbl_vacaciones DROP CONSTRAINT tbl_vacaciones_tbl_usu_fk;
       public          postgres    false    254    272    4859            �      x������ � �      �      x������ � �      �      x������ � �      �   �   x���1�0k���	0DB�J��}X��/�%y?$Ԕ�#�n���c�Ey`�6�Bǅ�l�4a�E�$+�R�&e;e������0��@��g�S]�z\D��+�\|̟�Y$T�X���H��u���[�-Tݺ�2c�c��~K�P*      �      x������ � �      �      x������ � �      �   �   x���
1���S�	����EA/�����Y��A��x�0�/K�є� h%Q������tn��X5�yB�ZbW�Oi�	!�h�и����$|���.�d����i�ϪNiki����D�%��Л_�C:�W��#:9)���γ�I+�Z�N���p��ON�54��$�{���kD�      �   �   x����0D��WlI�H9{sD	�@P�Ya+Z�@���c�fFzoN���O����+�8.���k����/��X�yb�$�Cd��5m�+RT5�#�F/��4�(?�L�z,S��wx����~m(���P��Q���*�            x������ � �      �      x������ � �      �   a   x�3�t�K�IKLJ-I�2�(��M,�LT��K��-��#D�ab&���ɥy)�jM����8C�2�R��3K�5��I��Xp��+8�d&'r��qqq �9�      �   L   x�3���)I-��2�tN,NL��2���<�9O��3�(�˄�%�,�(9$g��Y
��8��r2��b���� >7�      �   R   x�3�tL.�,��2���K�0����Ă��̒Ĕ|.ΰ�d '?/��˔�%U�)1+�ˌӿ�(��˜�)'��4�4F��� 6��      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �   *   x�3��M,)-��K�2�K-.H-s�9��KJ��=... �/�      �   �  x�}�ю� F��)x�n A�w����\Lcv����%�b�6������LbL�������*�#��H�c�����������a)1)j�k.�jd;H�$�z�*�I��q8�0����C��?��C~<��]��p��,GM����<�#���f�wO}�Jw���v-aeJb&
,����e6�p����K�ެ��lZD�*DOXJ��\m k{�a�N�X�\�?ਪ`s�:KQs��}��G��o�[ェ
y2`���*�j	OJr�������0�k(kZ%���*�ze�ִ��<�_�Q���/nK$hJ4"Q�c�g�����t#������OI����><�k9���#ܤL
J:+�`��y�84�`Pv2��H~�%��D���fOZ�c!����Y�&*j*�����ِ��mя(X�~��d��)J�(�X\8:��Q�oY����t�      �   3	  x�uXYr#���N�8Xk��ԭ�ڬ����@E4E��A&�:�����b~�	Iu���%
K�ɦhՍ^\��Uv֔K��_<8���g&S�ǽ���su&���
��V��\�/zX\z=tv�s+�dzWj�����ɇ7��N倍:��7=F���V��������3�"tN�Mzqɟ��ݨ��b�Z�����6/�J�s�R�n��[�{k�y�l�.�N�7Z��Z���x�[0L��':	�$����߂�#�L�5��w���IK7��@�fHo;=X%����&�W�ƼT���݋��juk=�｜ݨ�77�73ղ%����v��^
�FC+O�Wg�2r��ټf-/n��լ���G����k��d�&�^�gX��@��Ä�Ȇ�;.n��誆�����U�����<k�%1tf����@��c -0���н,(�E�<�p�>��y#kW�S�;��s�o�����vtL����2ϵM�q��:��Ku��z����X^Ҋ2a
hHV���)N�CT9ۀ�J |�M�w�y����\/�okf���>M�;�'�J�%�����˥zFDt>�3��,�� j�}��v�
u�s�Tv��p��g(�Gf*���C`�8��>փ\f�5����_�[<M��V��Dd�����di���d&b�����XFʪ�K������/D��<�v�E�����|�5y��#�0��o��V����.�Ku���g�>­x�<W�|�a�̸�rV^~Tۥ84��M�FK�'�:��:jWE�=\�$�O����0B��Vv��A�gm�T�^\�@�>顷�;?�"
����Q��u�{C��0�%��ҙ�SM
ػ��w"��?:��\��i�Y|�d#��s���J�@E
{=�y�4��'�/�`���������U���(�[�-ݨOv�<���Q?�-���@��jd��,�O
.1�Bw��	�'Ճ�1�z�O�^��DLM��m�7�z�s���@^�҅��FŖPCX9����i\zQH�ޮ��3���P\�<�A�uʹ8��v@�9f�TK�	�%=��\{p[�u�0����I#l�@Sؽ��������5���"vR�M	W�U��
sv�1;ĩV-�Z��@�ma�7�8!�n��᠚~0,D�{�hqt8����(����y���e�3�2d�����%�.�RQ�cǎsǙM�j��ku��x	i�F]�1H�1!X��Ķ��v�,CDH��Hd'厩�8M1S�F\~HT_��i��?`�:1<S5uGYkl��ԕ�=�#>����n��eKED߀�$�LqWDG�^���u}�����Έ������ J�����¯�š�Ep<$!:�WT��6e����sK�c�z�p�g��j��W����wfc��j�K�eŇ ���y�Q["���pLTG�{
S����(Z�Ie�8s)���2�K\[��MZ�mz��W��s���YA�P��!�����3���'`M e5�(35��,"&2l	OiU��N�H�L������d��ƌ&T~h �`�y�~
�Ȕ��iZ��q��p[���Â�Wm�|p�ȶ�L{�XB�����L�ݱ�>�o͗P��)@�4�QS��r1g ���4�b��ݬ-TVʲ�����@}�f�vH�+�i�B[n�Y�B{߹4�d%Q�����.l~��*R2\ t̰���n2�	�5�3���2��V\�����>�7s\FB�sIKp�����/� Ey��61��Z"��q�� �� ]��d;�W<�#��"�V���(�2Հ���;�6fZ֥�4�0��|<e��B��Q���B�2=�����������R��W�̊�)���w�O���B��qs~LP9C��m�7�K��6��~>�E'�~ܢ)~,1禓����J���q���?t�"Dz�}��B�s]�<*���Y����/\�+���k�7	ej=�0$(W�w�193h$�K������s��>�J��XX}~	>����W����RC�"Պ�{Y������P�pi��.29�)����f���^`�'�[���>�Z=�E'�T��0؎�0S���x���D�� �=�E�d\��v���@��Y����^(�g�Q�IœÇ��<�Gb�u��l�Ӫ��K��q�<���v;�&�����U2� ��{��}i�FxH���hƨ�}���Q*p�����(����x �2��ە�@�+��}��<f���L�s���<r���7�2>��N-&��uޣ(N��.$1���:�Q6���q������G^�����?^�������%��]      �      x�3����K)-J=�1�+F��� :��      �      x������ � �      �     x�]�Kn1е�0�?�,/s���![�%�A�Ų<42�E���0
�����ڲ@[�D���ƊPȖ���m�oJt��$Ŏr0W����&\�
_��.8�t�1��'\�/`r��O�z^OFKϒ�KV�B(G��*�@&[,L1��L���P���2&����`L&�1�,�d�Y�����p.�hSa�w�]����kr�Ҽ{�>��Y�	���)����:��BQ.��]���l[��      �   �  x�}VQ��6�Μ"��=�3�^� � ;�T~d,{���%a�do��	r�T����%ff"��.lԯ���^k��t{ǵ��;4������`I��2��BN~e<�?��	����f{3�:��m��+^ղ���@՝P���4��i��se�s�L���������ŀ֮K�_�"�D�E�w�̻�T�ii�Dr���K|-U'��J�]���'f�V��P�6�Оك��:�-�h�=�HaxSwx,-^�����@�]W�<-ӈ�l��(&�j:#Ҍ�6ˢdaL���Q����nA��ซм��8 A�2���J��4��$��J: �wEy��Vqєfq6<Ǉ�a>����	�� ����)��`yA��$F>\��}b�	�06G'IH��C��+(�$�^@�0$%+�4�?�7�
�#�E����=r���Q�d|C���K,�i��B��{��4��C��	����?���.��=�Ғ�i���
K�Fi |<XM<x�=���=�ۂ��`���ݡ�����msm�[o*�E6F	J�&�L`�y3̼x��G ����m�;���G�о0!J|t�T�hT�c_㷄��J�G��^`;ˊ�d�m�h��ڞ��F�/P~I��=��!�i{�LK�Dr�����=����~���s�������l˦v@*7�썡�[3�I�w����Rp�� �¤򿧪���\U���������j�H�~�hd�L�����>�Km3�k�p�ʾ[F��]*�F�����-ܦ>6��w�(zE��k�	_�W�`M��O���s��=�[T�St%��*.^I�44.�#M7F�v�V���&pvtb�8�GT����Mm�@Ӣ:
\7�r�e��-���,�����	2�MH��G!Z�x6�n��QR[�Zp�;sq�x��3��P�S�.쨲��hN�~̸F��>��}F8�����)~�G}����;��������?�      �      x������ � �      �      x������ � �      �      x�E�;�0��)r$>����������R�E�U�6����m��A�>��Ϝ�S�Wq;�l����(RF��t��LfyIa��]����Aa^��#ݱr-�D�Z>SN�/��_zn�s5:�      �   O   x�3�t-.IL�WHIUN�)M�2�tI��,�WN�(M��2��I-���K-�2�t�(HM�L�+IUp����L������ /�B      �      x������ � �      �   �  x�=Rˎ�0<���_PH�K:�z� A61b_�����J�@�o��C�"?Vr�t�!��9�6hhL�p�b�,���\���0�p�h���tE�2�S�!��KT�L?��=t�Y9J�������O[�
c��jH�)��p�X��L�0\M[��D]υ��X�ݛ(�Y澣�B�|4a���K=��T�%l+hÄ����n	?(y�::���:3�2�᝕���&���N[��:��7ԟ��/���Ģ���PN���0��ثx�UI�,{�}�p	ߗ�=���wgR��@c���#���R*V���0�1��4�~]QW��Bq��/���p���f׽��E�{"ͷ�V���J'۟)9�+%��.ՈS��r��{���}z%��<2#�\B����
�׬��S�kp-{5�����2�gm8-]�Xk˔(��,g��mW��R��/���E�� �����Y�vZ����n�aw��/q�xً�F}�����A��      �   1   x����M,N.�����24�tK�M��9\RKR�r3���b���� =�&      �   �   x�3�tt����tL����,.)JL�/��Rs�9��R� �^r~.��Q����J�w�w�w��OeAqI��{��q�I��wf��ka��_ia@nNJXI�I�aqT��QP�Y0���1qB�� ��4������ ^^*0      �      x������ � �     