CREATE TABLE pessoa (
pessoaId INT(10) NOT NULL AUTO_INCREMENT,
nome VARCHAR(35) NOT NULL,
sobrenome VARCHAR(35),
usuario VARCHAR(35) NOT NULL,
senha VARCHAR(35) NOT NULL,
nivel INT(10),
admin BOOLEAN,
foto VARCHAR(300),
PRIMARY KEY (pessoaId)
);

INSERT INTO pessoa (nome, sobrenome, usuario, senha, nivel, admin) VALUES ('Rafael', 'Tessarolo', 'rafael', MD5('1234'), 10, true);

CREATE TABLE casa (
casaId INT(10) NOT NULL AUTO_INCREMENT,
proprietarioId INT(10),
nome VARCHAR(35),
endereco VARCHAR(100),
cidade VARCHAR(35),
cep VARCHAR(12),
foto VARCHAR(300),
FOREIGN KEY (proprietarioId) REFERENCES pessoa(pessoaId),
PRIMARY KEY (casaID)
);

INSERT INTO casa (proprietarioId, nome, endereco, cidade, cep) VALUES (1, 'Casa da Praia', 'Av Banaguara', 'Fortaleza', '12345678');
INSERT INTO casa (proprietarioId, nome, endereco, cidade, cep) VALUES (1, 'Casa de Valinhos', 'Estrada Municipal', 'Valinhos', '12312455');

CREATE TABLE morador (
moradorId INT(10) NOT NULL AUTO_INCREMENT,
pessoaId INT(10),
casaId INT(10),
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
comodoId INT(10),
nome VARCHAR(35),
descricao VARCHAR(35),
status BOOLEAN,
FOREIGN KEY (comodoId) REFERENCES comodo(comodoId) ON DELETE CASCADE,
PRIMARY KEY (aparelhoId)
);

INSERT INTO aparelho (comodoId, nome, descricao) VALUES (1, 'TV 42', 'TV da sala');
INSERT INTO aparelho (comodoId, nome, descricao) VALUES (1, 'Lampada LED', 'Lampada principal da Sala');
INSERT INTO aparelho (comodoId, nome, descricao) VALUES (2, 'TV 32', 'TV da cozinha');

CREATE TABLE rotina (
rotinaId INT(10) NOT NULL AUTO_INCREMENT,
aparelhoId INT(10),
dataHora TIMESTAMP,
acao BOOLEAN,
descricao VARCHAR(35),
FOREIGN KEY (aparelhoId) REFERENCES aparelho(aparelhoId) ON DELETE CASCADE,
PRIMARY KEY (rotinaId)
);

INSERT INTO rotina (aparelhoId, dataHora, acao, descricao) VALUES (2, '2019-12-21 16:24:12', true, 'Apagar a luz no dia 21');

CREATE TABLE ativacao (
ativacaoId INT(10) NOT NULL AUTO_INCREMENT,
aparelhoId INT(10),
dataHora TIMESTAMP,
acao BOOLEAN,
descricao VARCHAR(35),
PRIMARY KEY(ativacaoId)
);

INSERT INTO ativacao (aparelhoId, dataHora, acao, descricao) VALUES (1, '2020-02-03 15:46:34', true, 'Rafael desligou TV 42');