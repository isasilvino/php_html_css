-- Criar o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS adote_mais;
USE adote_mais;

-- Tabela de ONGs
CREATE TABLE IF NOT EXISTS ongs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    endereco TEXT,
    cidade VARCHAR(100),
    estado CHAR(2),
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de Animais
CREATE TABLE IF NOT EXISTS animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    raca VARCHAR(100),
    idade VARCHAR(50),
    porte VARCHAR(50),
    sexo ENUM('M', 'F') NOT NULL,
    descricao TEXT,
    foto VARCHAR(255),
    status ENUM('disponivel', 'adotado', 'indisponivel') DEFAULT 'disponivel',
    ong_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ong_id) REFERENCES ongs(id)
);

-- Tabela de Candidaturas de Adoção
CREATE TABLE IF NOT EXISTS candidaturas_adocao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    endereco TEXT NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado CHAR(2) NOT NULL,
    motivo TEXT NOT NULL,
    status ENUM('pendente', 'aprovada', 'rejeitada') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (animal_id) REFERENCES animais(id)
); 