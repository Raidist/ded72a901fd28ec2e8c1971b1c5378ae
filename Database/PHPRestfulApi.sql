PGDMP         /                 y            PHPResfulApi    13.1    13.1     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16394    PHPResfulApi    DATABASE     q   CREATE DATABASE "PHPResfulApi" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Indonesian_Indonesia.1252';
    DROP DATABASE "PHPResfulApi";
                postgres    false            �           0    0    DATABASE "PHPResfulApi"    COMMENT     L   COMMENT ON DATABASE "PHPResfulApi" IS 'Technical Test for Job Application';
                   postgres    false    2995            �            1259    16460    auto_increment    SEQUENCE     {   CREATE SEQUENCE public.auto_increment
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999
    CACHE 1;
 %   DROP SEQUENCE public.auto_increment;
       public          postgres    false            �           0    0    SEQUENCE auto_increment    COMMENT     B   COMMENT ON SEQUENCE public.auto_increment IS 'add_autoincrement';
          public          postgres    false    201            �            1259    16396    email_comment    TABLE     �   CREATE TABLE public.email_comment (
    email character varying(50) NOT NULL,
    id bigint DEFAULT nextval('public.auto_increment'::regclass) NOT NULL,
    comment character varying(100),
    user_id bigint
);
 !   DROP TABLE public.email_comment;
       public         heap    postgres    false    201            �            1259    16473    tbl_user    TABLE     �   CREATE TABLE public.tbl_user (
    id bigint DEFAULT nextval('public.auto_increment'::regclass) NOT NULL,
    username character varying(100) NOT NULL,
    special_id character varying(100),
    password character varying(100) NOT NULL
);
    DROP TABLE public.tbl_user;
       public         heap    postgres    false    201            )           2606    16468     email_comment email_comment_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.email_comment
    ADD CONSTRAINT email_comment_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.email_comment DROP CONSTRAINT email_comment_pkey;
       public            postgres    false    200            +           2606    16477    tbl_user user_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.tbl_user
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.tbl_user DROP CONSTRAINT user_pkey;
       public            postgres    false    202           