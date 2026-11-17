#Montador de Elenco

Aplicação web full stack desenvolvida para gerenciamento e escalação de elencos esportivos, integrando uma interface interativa em JavaScript a uma API REST em PHP com persistência em MySQL.

Projeto acadêmico desenvolvido durante o curso de Ciência da Computação (PUCPR), focado na aplicação prática de arquitetura cliente-servidor, manipulação dinâmica do DOM e comunicação HTTP assíncrona.

---

##Funcionalidades

- **Cadastro de Jogadores:** Registro com nome, posição tática (ex: ATA, MEI, ZAG) e número da camisa.
- **Listagem em Tempo Real:** Consulta e renderização dinâmica dos jogadores cadastrados.
- **Edição de Atributos:** Atualização rápida de informações cadastrais via requisição HTTP `PUT`.
- **Exclusão Lógica (*Soft Delete*):** Desativação de registros sem perda física no banco de dados (`ativo = 0`), garantindo integridade referencial e histórico.

---

##Tecnologias e Conceitos Aplicados

### Backend
- **PHP Puro:** Implementação de endpoints RESTful estruturados.
- **PDO (PHP Data Objects):** Camada de abstração de banco de dados com *Prepared Statements* para prevenção contra SQL Injection.
- **HTTP & CORS:** Controle explícito de cabeçalhos (`Access-Control-Allow-*`) e tratamento de requisições de preflight com o método `OPTIONS`.
- **JSON nativo:** Comunicação serializada (`json_encode` / `json_decode`).

### Frontend
- **JavaScript Vanilla:** Requisições assíncronas utilizando a `Fetch API` e Promises.
- **Manipulação do DOM:** Atualização dinâmica de tabelas e estados da interface sem recarregar a página.
- **HTML5 & CSS3:** Layout limpo e responsivo para organização visual do time escalado.

### Banco de Dados
- **MySQL:** Modelagem relacional com controle de status ativo/inativo.

---

##Estrutura do Projeto

```text
montador-de-elenco/
├── Backend/
│   └── index.php       # Endpoints da API REST (GET, POST, PUT, DELETE)
├── Frontend/
│   ├── index.html      # Estrutura da interface
│   ├── style.css       # Estilização visual
│   └── func.js         # Lógica cliente e chamadas fetch()
├── Script.sql          # Script de criação da tabela no MySQL
└── README.md           # Documentação do projeto
```

---

##Como Executar Localmente

###Pré-requisitos
- PHP 8.x instalado
- Servidor MySQL ativo (ex: via XAMPP, WampServer ou serviço local)
- Navegador web moderno

### 1. Configurar o Banco de Dados
No seu gerenciador MySQL (phpMyAdmin, Workbench ou terminal), execute o script:
```sql
CREATE DATABASE IF NOT EXISTS elenco;
USE elenco;

CREATE TABLE IF NOT EXISTS jogadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    posicao VARCHAR(10) NOT NULL,
    camisa INT NOT NULL,
    ativo TINYINT(1) DEFAULT 1
);
```

> **Nota:** Certifique-se de ajustar as credenciais de conexão em `Backend/index.php` (usuário e senha do MySQL local).

### 2. Iniciar o Servidor Backend (PHP)
Abra o terminal na pasta `Backend` e utilize o servidor embutido do PHP:
```bash
cd Backend
php -S localhost:8000
```

### 3. Abrir o Frontend
Basta abrir o arquivo `Frontend/index.html` em qualquer navegador (ou utilizar a extensão *Live Server* do VS Code).

---

## 👨‍💻 Autor

Desenvolvido por **João Gabriel Dib Baby**  
- LinkedIn: [João Dib Baby](https://www.linkedin.com/in/jo%C3%A3o-dib-baby/)  
- GitHub: [jgdibbaby](https://github.com/jgdibbaby)
