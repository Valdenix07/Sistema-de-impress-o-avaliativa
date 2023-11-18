<?php
require('Config.php');

$curso = filter_input(INPUT_POST, 'curso');
$disciplina = filter_input(INPUT_POST, 'disciplina');
$turma = filter_input(INPUT_POST, 'turma');
$turno = filter_input(INPUT_POST, 'turno');
$professor = filter_input(INPUT_POST, 'professor');
$tipo = filter_input(INPUT_POST, 'tipo');
$dataprova = filter_input(INPUT_POST, 'data');
$qtdfolhas = filter_input(INPUT_POST, 'folhas');
$situacao = filter_input(INPUT_POST, 'situacao');
$datasituacao = filter_input(INPUT_POST, 'datasitu');

echo $curso; 

// Preparar a consulta SQL
$sql = $conn->prepare("INSERT INTO provas (curso, disciplina, turma, turno, professor, tipo, dataprova, qtdfolhas, situacao, datasituacao) 
VALUES (:curso, :disciplina, :turma, :turno, :professor, :tipo, :dataprova, :qtdfolhas, :situacao, :datasituacao)");

// Associar valores aos parâmetros da consulta
$sql->bindValue(':curso', $curso);
$sql->bindValue(':disciplina', $disciplina);
$sql->bindValue(':turma', $turma);
$sql->bindValue(':turno', $turno);
$sql->bindValue(':professor', $professor);
$sql->bindValue(':tipo', $tipo);
$sql->bindValue(':dataprova', $dataprova);
$sql->bindValue(':qtdfolhas', $qtdfolhas);
$sql->bindValue(':situacao', $situacao);
$sql->bindValue(':datasituacao', $datasituacao);

// Executar a consulta SQL
$sql->execute();

echo "Dados inseridos com sucesso na tabela.";

header('Location: ../Tabela.php');

?>
