-- CRIAÇÃO DO BANCO --
CREATE DATABASE akatsuki_travel;

-- Tabela de usuários
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo VARCHAR(10) NOT NULL CHECK (tipo IN ('admin', 'cliente'))
);

-- Tabela de viagens
CREATE TABLE viagens (
    id SERIAL PRIMARY KEY,
    destino VARCHAR(100) NOT NULL,
    embarque VARCHAR(100) NOT NULL,
    horario TIMESTAMP NOT NULL,
    poltronas INT NOT NULL CHECK (poltronas > 0),
    poltronas_disponiveis INT NOT NULL CHECK (poltronas_disponiveis >= 0),
    preco numeric
);

-- Tabela de reservas
CREATE TABLE reservas (
    id SERIAL PRIMARY KEY,
    id_viagem INT REFERENCES viagens(id),
    id_cliente INT REFERENCES usuarios(id),
    data_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    poltronas_reservadas INT NOT NULL CHECK (poltronas_reservadas > 0)
);

-- Admin padrão (senha: admin123)
INSERT INTO usuarios (nome, email, senha, tipo) VALUES (
    'Admin',
    'admin@email.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin'
);