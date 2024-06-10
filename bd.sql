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
    cpf VARCHAR(20),
    senha_sistema VARCHAR (25)
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

CREATE TABLE arquivos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    tamanho INT NOT NULL,
    conteudo LONGBLOB NOT NULL
);

SELECT * FROM advogados;

INSERT INTO advogados (nome, especializacao, numero_oab, endereco, telefone, email, data_nascimento, data_admissao, estado_civil, genero, nacionalidade, rg, cpf, senha_sistema) 
VALUES ('João Silva', 'Direito Penal', '123456', 'Rua das Flores, 123', '(99) 9999-9999', 'joao@example.com', '1980-01-01', '2020-01-01', 'Solteiro', 'Masculino', 'Brasileiro', '1234567', '123.456.789-10', 'senha123'),
       ('Maria Santos', 'Direito Civil', '987654', 'Avenida dos Advogados, 456', '(88) 8888-8888', 'maria@example.com', '1985-05-05', '2018-05-01', 'Casada', 'Feminino', 'Brasileira', '7654321', '987.654.321-00', 'senha456');
