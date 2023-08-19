--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

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

DROP DATABASE IF EXISTS frame;
--
-- Name: frame; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE frame WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Russian_Russia.1251' LC_CTYPE = 'Russian_Russia.1251';


ALTER DATABASE frame OWNER TO postgres;

\connect frame

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
-- Name: history; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.history (
    id integer NOT NULL,
    date_create timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    price integer DEFAULT 0 NOT NULL,
    count integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.history OWNER TO postgres;

--
-- Name: history_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.history_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.history_id_seq OWNER TO postgres;

--
-- Name: history_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.history_id_seq OWNED BY public.history.id;


--
-- Name: news; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.news (
    id integer NOT NULL,
    title character varying(120) NOT NULL,
    short_description character varying(255) DEFAULT NULL::character varying,
    description text NOT NULL,
    date_create timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.news OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.news_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.news_id_seq OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;


--
-- Name: product; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product (
    id integer NOT NULL,
    title character varying(100) NOT NULL,
    price integer NOT NULL,
    description text,
    count integer DEFAULT 0 NOT NULL,
    file_path character varying(200) DEFAULT '\app\web\img\default.png'::character varying NOT NULL
);


ALTER TABLE public.product OWNER TO postgres;

--
-- Name: product_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_id_seq OWNER TO postgres;

--
-- Name: product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(120) NOT NULL,
    login character varying(24) NOT NULL,
    password character varying(250) NOT NULL,
    is_admin boolean DEFAULT false NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: history id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.history ALTER COLUMN id SET DEFAULT nextval('public.history_id_seq'::regclass);


--
-- Name: news id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);


--
-- Name: product id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: history; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.history (id, date_create, price, count, user_id) FROM stdin;
1	2023-08-19 09:24:31.634164	2466920	5	1
2	2023-08-19 09:42:00.551667	10	1	7
\.


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news (id, title, short_description, description, date_create, user_id) FROM stdin;
3	111	111	111новое	2023-07-28 16:30:26.329272	1
1	Наименование новости	Краткое описание новости	Описание новости Описание новости Описание новости Описание новости Описание новости Описание новости Описание н1233123овости Описание новости Описание новости Описание новости 111111111111111111111	2022-05-05 17:55:47	1
2	Наименование новости 2 новое	Краткое описание новости 2 новое 	Описание новости 2 Описание новости 2 Описание новости 2 Описание новости 2 Описание новости 2 Описание новости 2 Описание новости 2 Описание новости 2 Описание новости 2 \r\nПРОВЕРКА	2022-05-06 06:40:24	1
4	1	1	1	2023-08-01 16:05:02.898295	1
5	111	111	111	2023-08-19 08:54:58.183145	1
\.


--
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product (id, title, price, description, count, file_path) FROM stdin;
7	123	123	123	0	\\app\\web\\img\\Bottle-of-beer-mock-up-TOONILLA+WEB.png
8	123	123	123	0	\\app\\web\\img\\Bottle-of-beer-mock-up-TOONILLA+WEB.png
3	111	10	описание	9	\\app\\web\\img\\default.png
4	11	11	11	9	\\app\\web\\img\\default.png
6	123	123	123	0	\\app\\web\\img\\default.png
5	123	123	123	0	\\app\\web\\img\\default.png
2	p[	123	hgjghjghjhgjhgjhgjhg	11	\\app\\web\\img\\default.png
1	123ппп	1233444	123ывмывмпыцмпыцм	123442	\\app\\web\\img\\default.png
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, login, password, is_admin) FROM stdin;
1	admin	admin	$2y$10$G9mhZHzTIReQY3OhqebeQuF9SXqWylXwqP6ukw23MHBrm94yZTfAi	t
2	user	user	$2y$10$Y/gftkXEwWbTZPDmO5QJm.fbM/2MiOplLNLWufWpUi32k.TWKbhW2	f
8	111	111	$2y$10$Iq/L0uzIzNYfS1jH5D6yXuFFi/OPgl2PbNhlcl.CZz/nWGzfcmBlO	f
7	123	123	$2y$10$dfJZgMUSqsVR4f59HD9VV.sPL2mRRInqMdRrdEYBxsqMjT8S11x3S	f
5	123	123	$2y$10$dfJZgMUSqsVR4f59HD9VV.sPL2mRRInqMdRrdEYBxsqMjT8S11x3S	t
\.


--
-- Name: history_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.history_id_seq', 2, true);


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.news_id_seq', 5, true);


--
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_id_seq', 8, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 10, true);


--
-- Name: history history_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.history
    ADD CONSTRAINT history_pkey PRIMARY KEY (id);


--
-- Name: news news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- Name: product product_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

