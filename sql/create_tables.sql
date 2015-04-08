CREATE SCHEMA words;

-- Table en
CREATE TABLE en (
    id integer NOT NULL,
    word character varying(45),
    len integer,
    letters_nb integer,
    complexity numeric(8,5)
);
CREATE SEQUENCE en_id_seq1 START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER SEQUENCE en_id_seq1 OWNED BY en.id;
ALTER TABLE ONLY en ALTER COLUMN id SET DEFAULT nextval('en_id_seq1'::regclass);
ALTER TABLE ONLY en ADD CONSTRAINT en_pkey1 PRIMARY KEY (id);
ALTER TABLE ONLY en ADD CONSTRAINT en_word_key UNIQUE (word);


-- Table letter_details
CREATE TABLE letter_details (
    table_name character varying(3) NOT NULL,
    word_id integer NOT NULL,
    letter character(1) NOT NULL,
    occurences integer
);
ALTER TABLE ONLY letter_details ADD CONSTRAINT letter_details_pkey PRIMARY KEY (table_name, word_id, letter);