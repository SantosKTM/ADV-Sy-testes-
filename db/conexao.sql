CREATE DATABASE IF NOT EXISTS conexao_cadastro;
DROP DATABASE conexao_cadastro;
USE conexao_cadastro;

CREATE TABLE novo_cliente (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nome_completo VARCHAR(100),
    tipo_cliente ENUM('Pessoa Física', 'Pessoa Jurídica'),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    dt_nasc DATE NOT NULL,
    email VARCHAR (60) NOT NULL,
    tel VARCHAR (20) NOT NULL,
    cpf VARCHAR (12) NOT NULL,
    rg VARCHAR (15) NOT NULL,
    bairro VARCHAR (30) NOT NULL,
    cidade VARCHAR (25) NOT NULL,
    rua VARCHAR(25) NOT NULL,
    num NUMERIC NOT NULL
);

CREATE TABLE advogados (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    especializacao ENUM('Direito Penal', 'Direito Civil', 'Direito Trabalhista', 'Direito Empresarial', 'Direito de Família', 'Outra'),
    numero_oab VARCHAR(20),
    endereco VARCHAR(255),
    telefone VARCHAR(20),
    email VARCHAR(100),
    data_nascimento DATE,
    data_admissao DATE,
    estado_civil VARCHAR(20),
    genero VARCHAR(20),
    nacionalidade VARCHAR(50),
    rg VARCHAR(20),
    cpf VARCHAR(20)
);

CREATE TABLE casos (
    id_caso INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    id_advogado INT,
    descricao TEXT,
    data_abertura DATE,
    data_encerramento DATE,
    status ENUM('Aberto', 'Fechado'),
    FOREIGN KEY (id_cliente) REFERENCES novo_cliente(id_cliente),
    FOREIGN KEY (id_advogado) REFERENCES advogados(id)
);

INSERT INTO novo_cliente (nome_completo, tipo_cliente, dt_nasc, email, tel, cpf, rg, bairro, cidade, rua, num)  
VALUES      
    ('Fulano da Silva', 'Pessoa Física', '1990-05-20', 'fulano@email.com', '11987654321', '12345678910', '123456789', 'Centro', 'São Paulo', 'Rua A', 123),     
    ('Empresa ABC Ltda', 'Pessoa Jurídica', '1995-01-01', 'contato@empresaabc.com', '11987654321', '12345678901234', NULL, 'Centro', 'São Paulo', 'Rua B', 456),     
    ('Ciclano Pereira', 'Pessoa Física', '1985-10-15', 'ciclano@email.com', '11987654321', '98765432100', '987654321', 'Centro', 'Rio de Janeiro', 'Rua C', 789),     
    ('Beltrano Oliveira', 'Pessoa Física', '1980-12-30', 'beltrano@email.com', '11987654321', '45678912300', '456789123', 'Centro', 'Salvador', 'Rua D', 1011),     
    ('Maria Silva Souza', 'Pessoa Física', '1978-03-25', 'maria@email.com', '11987654321', '98765432100', '987654321', 'Centro', 'Belo Horizonte', 'Rua E', 1213);


INSERT INTO advogados (nome, especializacao, numero_oab, endereco, telefone, email, data_nascimento, data_admissao, estado_civil, genero, nacionalidade, rg, cpf) 
VALUES 
    ('João Silva', 'Direito Penal', 'OAB12345', 'Av. Brasil, 123', '(11) 1234-5678', 'joao@email.com', '1980-08-10', '2020-01-15', 'Solteiro', 'Masculino', 'Brasileira', '12345678', '12345678901'),
    ('Maria Oliveira', 'Direito Civil', 'OAB54321', 'Rua Argentina, 456', '(22) 2345-6789', 'maria.advogada@email.com', '1975-11-20', '2015-05-20', 'Casada', 'Feminino', 'Brasileira', '87654321', '09876543210'),
    ('Pedro Santos', 'Direito Trabalhista', 'OAB67890', 'Rua Chile, 789', '(33) 3456-7890', 'pedro.advogado@email.com', '1990-04-15', '2018-09-30', 'Solteiro', 'Masculino', 'Brasileira', '56789012', '21098765432'),
    ('Ana Oliveira', 'Direito Empresarial', 'OAB09876', 'Av. Peru, 1011', '(44) 4567-8901', 'ana.advogada@email.com', '1988-12-25', '2016-07-10', 'Casada', 'Feminino', 'Brasileira', '34567890', '54321098765'),
    ('José Pereira', 'Direito de Família', 'OAB45678', 'Rua Uruguai, 1213', '(55) 5678-9012', 'jose.advogado@email.com', '1973-09-05', '2010-03-25', 'Divorciado', 'Masculino', 'Brasileira', '23456789', '43210987654');

CREATE TABLE arquivos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    tamanho INT NOT NULL,
    conteudo LONGBLOB NOT NULL
);

SELECT * FROM arquivos;
SELECT * FROM novo_cliente; 
SELECT * FROM advogados;
select id,nome FROM advogados;
SELECT * FROM casos;

