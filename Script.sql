USE elenco;

CREATE TABLE jogadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    posicao VARCHAR(10) NOT NULL,
    camisa INT NOT NULL,
    ativo TINYINT(1) DEFAULT 1
);

SELECT * FROM jogadores;