CREATE TABLE pessoa
(
	id 			INTEGER PRIMARY KEY,
	nome 		TEXT,
	cpf			char(11) UNIQUE,
	email		varchar(150),
	telefone	varchar(20)
);

CREATE TABLE uf
(
	id			INTEGER PRIMARY KEY,
	uf			CHAR(2),
	descricao	VARCHAR(30)
);

CREATE TABLE endereco
(
	id			INTEGER PRIMARY KEY,
	pessoa_id 	INTEGER,
	uf_id       INTEGER,
	logradouro	TEXT,
	complemento	TEXT,
	bairro		TEXT,
	cidade		TEXT,
	cep			CHAR(8),
	FOREIGN KEY(pessoa_id) REFERENCES pessoa(id),
	FOREIGN KEY(uf_id) REFERENCES uf(id)
);