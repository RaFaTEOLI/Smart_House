CREATE USER 'smart_house'@'localhost' IDENTIFIED BY 'fIHad42gf';
GRANT ALTER ROUTINE, ALTER, SHOW VIEW, SHOW DATABASES, SELECT, PROCESS, EXECUTE, CREATE, CREATE ROUTINE, CREATE TEMPORARY TABLES, CREATE TABLESPACE, CREATE VIEW, DROP, DELETE, INDEX, EVENT, INSERT, TRIGGER, REFERENCES, UPDATE, FILE, CREATE USER, LOCK TABLES, RELOAD, REPLICATION CLIENT, REPLICATION SLAVE, SHUTDOWN, SUPER  ON *.* TO 'smart_house'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;

DROP DATABASE IF EXISTS smart_house;
CREATE DATABASE smart_house;
USE smart_house;

CREATE TABLE status (
	statusId INT(10) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(30) NOT NULL,
	PRIMARY KEY (statusId)
);

INSERT INTO status (nome) VALUES ('Ativo');
INSERT INTO status (nome) VALUES ('Pendente');
INSERT INTO status (nome) VALUES ('Deletado');

CREATE TABLE pessoa (
	pessoaId INT(10) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(35) NOT NULL,
	sobrenome VARCHAR(35),
	email VARCHAR(300) NOT NULL,
	usuario VARCHAR(35) NOT NULL,
	senha VARCHAR(35) NOT NULL,
	nivel INT(10) NOT NULL DEFAULT '0',
	admin BOOLEAN NOT NULL DEFAULT '0',
	notifyEmail BOOLEAN NOT NULL DEFAULT '0',
	foto VARCHAR(300),
	statusId INT(10) NOT NULL DEFAULT '2',
	FOREIGN KEY (statusId) REFERENCES status(statusId),
	PRIMARY KEY (pessoaId)
);

INSERT INTO pessoa (nome, sobrenome, email, usuario, senha, nivel, admin, notifyEmail, statusId) VALUES ('Admin', 'Smart House', 'admin@smarthouse.com', 'admin', MD5('1234'), 10, true, true, 1);

CREATE TABLE estado (
	estadoId INT(10) NOT NULL AUTO_INCREMENT,
	nome CHAR(20) NULL DEFAULT '0',
	sigla CHAR(2) NULL DEFAULT NULL,
	PRIMARY KEY (estadoId)
);

INSERT INTO estado (nome, sigla) VALUES ('Acre', 'AC');
INSERT INTO estado (nome, sigla) VALUES ('Alagoas', 'AL');
INSERT INTO estado (nome, sigla) VALUES ('Amapá', 'AP');
INSERT INTO estado (nome, sigla) VALUES ('Amazonas', 'AM');
INSERT INTO estado (nome, sigla) VALUES ('Bahia', 'BA');
INSERT INTO estado (nome, sigla) VALUES ('Ceará', 'CE');
INSERT INTO estado (nome, sigla) VALUES ('Distrito Federal', 'DF');
INSERT INTO estado (nome, sigla) VALUES ('Espírito Santo', 'ES');
INSERT INTO estado (nome, sigla) VALUES ('Goiás', 'GO');
INSERT INTO estado (nome, sigla) VALUES ('Maranhão', 'MA');
INSERT INTO estado (nome, sigla) VALUES ('Mato Grosso', 'MT');
INSERT INTO estado (nome, sigla) VALUES ('Mato Grosso do Sul', 'MS');
INSERT INTO estado (nome, sigla) VALUES ('Minas Gerais', 'MG');
INSERT INTO estado (nome, sigla) VALUES ('Pará', 'PA');
INSERT INTO estado (nome, sigla) VALUES ('Paraíba', 'PB');
INSERT INTO estado (nome, sigla) VALUES ('Paraná', 'PR');
INSERT INTO estado (nome, sigla) VALUES ('Pernambuco', 'PE');
INSERT INTO estado (nome, sigla) VALUES ('Piauí', 'PI');
INSERT INTO estado (nome, sigla) VALUES ('Rio de Janeiro', 'RJ');
INSERT INTO estado (nome, sigla) VALUES ('Rio Grande do Norte', 'RN');
INSERT INTO estado (nome, sigla) VALUES ('Rio Grande do Sul', 'RS');
INSERT INTO estado (nome, sigla) VALUES ('Rondônia', 'RO');
INSERT INTO estado (nome, sigla) VALUES ('Roraima', 'RA');
INSERT INTO estado (nome, sigla) VALUES ('Santa Catarina', 'SC');
INSERT INTO estado (nome, sigla) VALUES ('São Paulo', 'SP');
INSERT INTO estado (nome, sigla) VALUES ('Sergipe', 'SE');
INSERT INTO estado (nome, sigla) VALUES ('Tocantins', 'TO');

CREATE TABLE casa (
	casaId INT(10) NOT NULL AUTO_INCREMENT,
	proprietarioId INT(10) NOT NULL,
	nome VARCHAR(35) NOT NULL,
	endereco VARCHAR(100) NOT NULL,
	cidade VARCHAR(35) NOT NULL,
	estadoId INT(10) NOT NULL,
	cep VARCHAR(12) NOT NULL,
	temperatura INT(10) NOT NULL DEFAULT '0',
	foto VARCHAR(300),
	FOREIGN KEY (proprietarioId) REFERENCES pessoa(pessoaId),
	FOREIGN KEY (estadoId) REFERENCES estado(estadoId),
	PRIMARY KEY (casaId)
);

INSERT INTO casa (proprietarioId, nome, endereco, cidade, estadoId, cep) VALUES (1, 'Casa da Praia', 'Av Banaguara', 'Fortaleza', 6, '12345678');
INSERT INTO casa (proprietarioId, nome, endereco, cidade, estadoId, cep) VALUES (1, 'Casa de Valinhos', 'Estrada Municipal', 'Valinhos', 25, '12312455');

CREATE TABLE morador (
	moradorId INT(10) NOT NULL AUTO_INCREMENT,
	pessoaId INT(10) NOT NULL,
	casaId INT(10) NOT NULL,
	data_cadastro DATE,
	FOREIGN KEY (pessoaId) REFERENCES pessoa(pessoaId) ON DELETE CASCADE,
	FOREIGN KEY (casaId) REFERENCES casa(casaId) ON DELETE CASCADE,
	PRIMARY KEY (moradorId)
);

INSERT INTO morador (pessoaId, casaId, data_cadastro) VALUES (1, 1, '2019-08-21');

CREATE TABLE comodo (
	comodoId INT(10) NOT NULL AUTO_INCREMENT,
	casaId INT(10),
	nome VARCHAR(35),
	andar INT(10),
	FOREIGN KEY (casaId) REFERENCES casa(casaId) ON DELETE CASCADE,
	PRIMARY KEY (comodoId)
);

INSERT INTO comodo (casaId, nome, andar) VALUES (1, 'Sala de TV', 1);
INSERT INTO comodo (casaId, nome, andar) VALUES (2, 'Cozinha', 1);

CREATE TABLE aparelho (
	aparelhoId INT(10) NOT NULL AUTO_INCREMENT,
	comodoId INT(10) NOT NULL,
	nome VARCHAR(35) NOT NULL,
	descricao VARCHAR(35),
  port VARCHAR(35) NULL,
	consumo DOUBLE NOT NULL DEFAULT '0',
	status BOOLEAN NOT NULL DEFAULT '0',
	FOREIGN KEY (comodoId) REFERENCES comodo(comodoId) ON DELETE CASCADE,
	PRIMARY KEY (aparelhoId)
);

INSERT INTO aparelho (comodoId, nome, descricao) VALUES (1, 'TV 42', 'TV da sala');
INSERT INTO aparelho (comodoId, nome, descricao) VALUES (1, 'Lampada LED', 'Lampada principal da Sala');
INSERT INTO aparelho (comodoId, nome, descricao) VALUES (2, 'TV 32', 'TV da cozinha');

CREATE TABLE cenas (
	cenaId INT(10) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
	descricao VARCHAR(100),
	dataHora TIMESTAMP,
	PRIMARY KEY(cenaId)
);

CREATE TABLE rotina (
	rotinaId INT(10) NOT NULL AUTO_INCREMENT,
	aparelhoId INT(10) NOT NULL,
	dataHora TIMESTAMP,
	acao BOOLEAN NOT NULL DEFAULT '0',
	descricao VARCHAR(35),
	cenaId INT(10) NULL,
	FOREIGN KEY (aparelhoId) REFERENCES aparelho(aparelhoId) ON DELETE CASCADE,
	FOREIGN KEY (cenaId) REFERENCES cenas(cenaId) ON DELETE CASCADE,
	PRIMARY KEY (rotinaId)
);

INSERT INTO rotina (aparelhoId, dataHora, acao, descricao) VALUES (2, '2019-12-21 16:24:12', true, 'Apagar a luz no dia 21');

CREATE TABLE ativacao (
	ativacaoId INT(10) NOT NULL AUTO_INCREMENT,
	aparelhoId INT(10) NOT NULL,
	pessoaId INT (10) NOT NULL,
	dataHora TIMESTAMP,
	acao BOOLEAN NOT NULL DEFAULT '0',
	descricao VARCHAR(35),
	PRIMARY KEY(ativacaoId)
);

INSERT INTO ativacao (aparelhoId, pessoaId, dataHora, acao, descricao) VALUES (1, 1, '2020-02-03 15:46:34', true, 'Rafael desligou TV 42');

CREATE TABLE log (
	logId INT(10) NOT NULL AUTO_INCREMENT,
	pessoaId INT(10) NOT NULL,
	casaId INT(10) NOT NULL,
	acao VARCHAR(30) NOT NULL,
	dataHora TIMESTAMP,
	descricao VARCHAR(300),
	ip VARCHAR(35),
	FOREIGN KEY (pessoaId) REFERENCES pessoa(pessoaId) ON DELETE CASCADE,
	FOREIGN KEY (casaId) REFERENCES casa(casaId) ON DELETE CASCADE,
	PRIMARY KEY (logId)
);

INSERT INTO log (pessoaId, casaId, acao, dataHora, descricao, ip) VALUES (1, 1, 'Inserir', NOW(), 'Rafael Inseriu a Casa ID: 1', '192.168.0.1');

CREATE TABLE mensagens (
	mensagemId INT(10) NOT NULL AUTO_INCREMENT,
	casaId INT(10) NOT NULL,
	dataMensagem TIMESTAMP,
	mensagem VARCHAR(300),
	tipo INT(10) NOT NULL,
	lida BOOLEAN NOT NULL DEFAULT '0',
	FOREIGN KEY (casaId) REFERENCES casa(casaId) ON DELETE CASCADE,
	PRIMARY KEY (mensagemId)
);

INSERT INTO mensagens (casaId, dataMensagem, mensagem, tipo) VALUES (1, NOW(), 'Bem-vindo ao sistema Houser!', 1);
INSERT INTO mensagens (casaId, dataMensagem, mensagem, tipo) VALUES (2, NOW(), 'Bem-vindo ao sistema Houser!', 1);

CREATE TABLE relatorio (
	relatorioId INT(10) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
	descricao VARCHAR(100),
	`sql` TEXT NOT NULL,
	data_cadastro DATE,
	PRIMARY KEY(relatorioId)
);
INSERT INTO relatorio (relatorioId, nome, descricao, `sql`, data_cadastro) VALUES (1, 'Horarios ativação aparelhos', 'Horarios em que são mais ativados os aparelhos', 'SELECT CONCAT(HOUR(dataHora), "h") AS Hora, COUNT(acao) AS Quantidade\r\nFROM ativacao AS a\r\nINNER JOIN aparelho AS ap ON ap.aparelhoId = a.aparelhoId\r\nINNER JOIN comodo AS cd ON ap.comodoid = cd.comodoid\r\nINNER JOIN casa AS ca ON cd.casaid = ca.casaid\r\nWHERE ca.casaid = __CASAID__ AND acao = 1\r\nGROUP BY HOUR(dataHora);', '2020-03-27');
