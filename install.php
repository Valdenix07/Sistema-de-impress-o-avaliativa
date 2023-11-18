<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "si_uninassau";

echo '<pre>';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error.'<br>');
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(200) NOT NULL,
  senha VARCHAR(200) NOT NULL
)";

    
    if ($conn->query($sql) === TRUE) {
      echo "Table clientes created successfully".'<br>';
    } else {
      echo "Error creating table: " . $conn->error.'<br>';
    }

    //inclusão de usuario teste

/*
$sql = "INSERT INTO usuarios (email, senha) VALUES ('teste@exemplo.com', 'senha123')";

if ($conn->query($sql) === TRUE) {
  echo "Inserir usuario teste feito successfully".'<br>';
} else {
  echo "Error creating table: " . $conn->error.'<br>';
}
*/

// SQL para criar a tabela "provas"
$sql = "CREATE TABLE IF NOT EXISTS provas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    curso varchar(100),
    disciplina varchar(100),
    turma varchar(30),
    turno varchar(30),
    professor varchar(50),
    tipo varchar(50),
    dataprova date,
    qtdfolhas int(10),
    situacao varchar(50),
    datasituacao date
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela provas criada com sucesso" . '<br>';
} else {
    echo "Erro ao criar a tabela: " . $conn->error . '<br>';
}

// SQL para inserir dados na tabela "provas"
$sql = "INSERT INTO provas (curso, disciplina, turma, turno, professor, tipo, dataprova, qtdfolhas, situacao, datasituacao) 
VALUES ('Farmácia', 'quimica analitica', '5° periodo', 'manha', 'marcones', 'Final', '2023-10-12', 10, 'entregue', '2023-10-5')";

if ($conn->query($sql) === TRUE) {
    echo "Inserção de dados na tabela provas feita com sucesso" . '<br>';
} else {
    echo "Erro ao inserir dados na tabela: " . $conn->error . '<br>';
}

// Fechar a conexão com o banco de dados
$conn->close();