--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3 (Debian 15.3-0+deb12u1)
-- Dumped by pg_dump version 15.3 (Debian 15.3-0+deb12u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: product_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_types (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    taxpercentage double precision NOT NULL,
    created_by_user_id integer,
    excluded boolean NOT NULL
);


ALTER TABLE public.product_types OWNER TO postgres;

--
-- Name: product_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_types_id_seq OWNER TO postgres;

--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id integer NOT NULL,
    product_type_id integer,
    name character varying(255) NOT NULL,
    price double precision NOT NULL,
    createdat timestamp(0) without time zone NOT NULL,
    updatedat timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    created_by_user_id integer,
    excluded boolean NOT NULL
);


ALTER TABLE public.products OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_id_seq OWNER TO postgres;

--
-- Name: sells; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sells (
    id integer NOT NULL,
    product_id integer,
    created_by_user_id integer,
    quantity integer NOT NULL,
    createdat timestamp(0) without time zone NOT NULL,
    excluded boolean NOT NULL
);


ALTER TABLE public.sells OWNER TO postgres;

--
-- Name: sells_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sells_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sells_id_seq OWNER TO postgres;

--
-- Name: user_groups; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_groups (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.user_groups OWNER TO postgres;

--
-- Name: user_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_groups_id_seq OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    group_id integer,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    isactive boolean NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Data for Name: product_types; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product_types (id, name, taxpercentage, created_by_user_id, excluded) FROM stdin;
14	Tipo de Produto Exemplo 7	10	1	f
15	Tipo de Produto Exemplo 7	10	1	f
13	Produto Limpeza	15	1	f
1	Tipo de Produto Exemplo	10	1	t
3	Tipo de Produto Exemplo	10	1	t
4	Tipo de Produto Exemplo	10	1	t
5	Tipo de Produto Exemplo	10	1	t
6	Tipo de Produto Exemplo	10	1	t
7	Tipo de Produto Exemplo 4	10	1	t
12	Tipo de Produto Exemplo 5	10	1	t
2	Produto Atualizado	10	1	t
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, product_type_id, name, price, createdat, updatedat, created_by_user_id, excluded) FROM stdin;
7	15	Produto Exemplo 1	100	2024-01-23 09:55:21	\N	1	f
5	15	Produto Exemplo 1	100	2024-01-23 09:52:45	\N	1	t
6	15	Produto Exemplo 1	100	2024-01-23 09:54:18	\N	1	t
8	15	Produto Atualizado	200	2024-01-23 09:56:15	2024-01-23 12:27:07	1	f
9	15	Produto Exemplo 5	100	2024-01-23 09:56:49	\N	1	t
10	15	Produto Exemplo 5	100	2024-01-23 12:35:54	\N	1	f
11	15	Produto Exemplo 10	100	2024-01-23 12:36:27	\N	1	f
1	15	Produto Exemplo	100	2024-01-23 09:42:09	\N	1	t
\.


--
-- Data for Name: sells; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sells (id, product_id, created_by_user_id, quantity, createdat, excluded) FROM stdin;
1	1	\N	5	2024-01-23 10:51:46	f
2	1	\N	5	2024-01-23 10:52:20	f
3	1	1	5	2024-01-23 10:55:33	f
4	1	1	5	2024-01-23 12:35:19	f
5	1	1	2	2024-01-23 13:14:47	f
\.


--
-- Data for Name: user_groups; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_groups (id, name) FROM stdin;
1	test
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, group_id, username, password, name, isactive) FROM stdin;
1	1	test	$2y$10$1zLuH2uPTZ5l8oJXjc3t2ObfiIHLWP1hHrx5X/hGCek/J8u4Of0dC	Test	t
2	1	testEdit2	$2y$10$uTM5B9eO/moZmtKCSzPcued2T.IU.yIpdS9Tu6GxzBfcSlVekblj.	Updated Name	f
\.


--
-- Name: product_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_types_id_seq', 15, true);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 11, true);


--
-- Name: sells_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sells_id_seq', 5, true);


--
-- Name: user_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_groups_id_seq', 3, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- Name: product_types product_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_types
    ADD CONSTRAINT product_types_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: sells sells_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sells
    ADD CONSTRAINT sells_pkey PRIMARY KEY (id);


--
-- Name: user_groups user_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_groups
    ADD CONSTRAINT user_groups_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: idx_1483a5e9fe54d947; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_1483a5e9fe54d947 ON public.users USING btree (group_id);


--
-- Name: idx_35215c5a4584665a; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_35215c5a4584665a ON public.sells USING btree (product_id);


--
-- Name: idx_35215c5a7d182d95; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_35215c5a7d182d95 ON public.sells USING btree (created_by_user_id);


--
-- Name: idx_b3ba5a5a14959723; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b3ba5a5a14959723 ON public.products USING btree (product_type_id);


--
-- Name: idx_b3ba5a5a7d182d95; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b3ba5a5a7d182d95 ON public.products USING btree (created_by_user_id);


--
-- Name: idx_f86cf26c7d182d95; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f86cf26c7d182d95 ON public.product_types USING btree (created_by_user_id);


--
-- Name: users fk_1483a5e9fe54d947; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT fk_1483a5e9fe54d947 FOREIGN KEY (group_id) REFERENCES public.user_groups(id);


--
-- Name: sells fk_35215c5a4584665a; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sells
    ADD CONSTRAINT fk_35215c5a4584665a FOREIGN KEY (product_id) REFERENCES public.products(id);


--
-- Name: sells fk_35215c5a7d182d95; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sells
    ADD CONSTRAINT fk_35215c5a7d182d95 FOREIGN KEY (created_by_user_id) REFERENCES public.users(id);


--
-- Name: products fk_b3ba5a5a14959723; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT fk_b3ba5a5a14959723 FOREIGN KEY (product_type_id) REFERENCES public.product_types(id);


--
-- Name: products fk_b3ba5a5a7d182d95; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT fk_b3ba5a5a7d182d95 FOREIGN KEY (created_by_user_id) REFERENCES public.users(id);


--
-- Name: product_types fk_f86cf26c7d182d95; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_types
    ADD CONSTRAINT fk_f86cf26c7d182d95 FOREIGN KEY (created_by_user_id) REFERENCES public.users(id);


--
-- PostgreSQL database dump complete
--

