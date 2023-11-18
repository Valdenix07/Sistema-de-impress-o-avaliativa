<?php
require('Config.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
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

    // Preparar a consulta SQL UPDATE
    $sql = $conn->prepare("UPDATE provas 
        SET curso=:curso, disciplina=:disciplina, turma=:turma, turno=:turno, professor=:professor, tipo=:tipo, dataprova=:dataprova, qtdfolhas=:qtdfolhas, situacao=:situacao, datasituacao=:datasituacao
        WHERE id=:id");

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
    $sql->bindValue(':id', $id);

    // Executar a consulta SQL UPDATE
    $sql->execute();

    echo "Dados atualizados com sucesso na tabela.";
}

header('Location: ../Tabela.php');
?>

