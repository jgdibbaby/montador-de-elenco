<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); 
    exit(0);
}

$host = 'localhost';
$dbname = 'elenco';
$username = 'root'; 
$password = '1234'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Falha na conexão"]);
    exit;
}

$metodo = $_SERVER['REQUEST_METHOD'];

//GET
if ($metodo === 'GET') {
    $stmt = $pdo->query("SELECT * FROM jogadores WHERE ativo = 1");
    $jogadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($jogadores);
}

//POST
elseif ($metodo === 'POST') {
    $dados = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $pdo->prepare("INSERT INTO jogadores (nome, posicao, camisa) VALUES (?, ?, ?)");
    $stmt->execute([$dados['nome'], $dados['posicao'], $dados['camisa']]);
    
    echo json_encode(["mensagem" => "Jogador cadastrado com sucesso"]);
}

//DELETE
elseif ($metodo === 'DELETE') {
    $id = $_GET['id'];
    
    $stmt = $pdo->prepare("UPDATE jogadores SET ativo = 0 WHERE id = ?");
    $stmt->execute([$id]);
    
    echo json_encode(["mensagem" => "Jogador excluído com sucesso"]);
}

//PUT
elseif ($metodo === 'PUT') {
    $id = $_GET['id'];
    $dados = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $pdo->prepare("UPDATE jogadores SET nome = ? WHERE id = ?");
    $stmt->execute([$dados['nome'], $id]);
    
    echo json_encode(["mensagem" => "Nome atualizado com sucesso"]);
}
?>