<?php
require('../backend/Config.php');

try {
    $stmt = $conn->prepare("SELECT * FROM provas");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="pt">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Tabela</title>
    <link rel="stylesheet" href="Tabela.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>
    <div id="cabecalho">
        <img id="logo-top-tabela" src="images/0d258eff-d65a-4926-8f12-6056faed0be1.jfif" alt="">
    </div>
    <div id="central-container">
        <a href="Cadastrar.html" >Novo</a>
        <form action="Pdf.php" method="post">
            <input type="submit" name="gerar_pdf" value="Relatório PDF" class="btn-relatorio">
        </form>
    </div>
    <div class="tabela-container">
        <table id="myTable">
            <thead>
                <tr style="height: 52px;">
                    <th>CURSO</th>
                    <th>DISCIPLINA</th>
                    <th>PROFESSOR</th>
                    <th>TIPO</th>
                    <th>TURMA</th>
                    <th>TURNO</th>
                    <th>DATA PROVA</th>
                    <th>COPIAS</th>
                    <th>SITUAÇÃO</th>
                    <th>DATA SITUAÇÃO</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td><?= $row["curso"] ?></td>
                        <td><?= $row["disciplina"] ?></td>
                        <td><?= $row["professor"] ?></td>
                        <td><?= $row["tipo"] ?></td>
                        <td><?= $row["turma"] ?></td>
                        <td><?= $row["turno"] ?></td>
                        <td><?= $row["dataprova"] ?></td>
                        <td><?= $row["qtdfolhas"] ?></td>
                        <td><?= $row["situacao"] ?></td>
                        <td><?= $row["datasituacao"] ?></td>
                        <td>
                            <a href="editar.php?id=<?= $row['id'] ?>" title="Editar">
                                <img style="height: 20px; margin-right: 10px; margin-top: 3px;" src="images/1828911-ec0d8d30.png" />
                            </a>
                            <a href="javascript:void(0);" title="Deletar" onclick="confirmDelete(<?= $row['id'] ?>)">
                                <img style="height: 20px; margin-right: 10px; margin-top: 3px;" src="images/542724-9d1184b3.png" />
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <script>
        function confirmDelete(id) {
            if (window.confirm("Tem certeza que deseja excluir este registro?")) {
                window.location.href = "backend/provadelete.php?id=" + id;
            }
        }
    </script>
</body>
</html>
