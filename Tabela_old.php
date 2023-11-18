<?php

 require('../backend/Config.php');
try {
 $stmt = $conn->prepare("SELECT * FROM provas");
$stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  //foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
    //print_r ($v);
  //}
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;


?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="pt"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Tabela</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">




  </head>
  <body data-lang="pt">
    <section id="sec-f057">
      <div>
        <div> </div>
        <img src="images/0d258eff-d65a-4926-8f12-6056faed0be1.jfif" alt="" data-image-width="915" data-image-height="370">
        <a href="Cadastrar.html">Novo</a>
        <a href="Relatorio.php">Relatorio</a>
        <form action="Pdf.php" method="post">
        <input type="submit" name="gerar_pdf" value="Relatório PDF">
        </form>

        <div>
          <table id="myTable">
            <thead>
              <tr>
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
              <?php foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v){
                        echo "<tr>";
                        echo "<td>".$v["curso"]."</td>";
                        echo "<td>".$v["disciplina"]."</td>";
                        echo "<td>".$v["professor"]."</td>";
                        echo "<td>".$v["tipo"]."</td>";
                        echo "<td>".$v["turma"]."</td>";
                        echo "<td>".$v["turno"]."</td>";
                        echo "<td>".$v["dataprova"]."</td>";
                        echo "<td>".$v["qtdfolhas"]."</td>";
                        echo "<td>".$v["situacao"]."</td>";
                        echo "<td>".$v["datasituacao"]."</td>";
                      echo "<td>
                        <a href='editar.php?id=$v[id]' title='Editar'><img style='height: 20px; margin-right: 10px ;margin-top: 3px;' src='images/1828911-ec0d8d30.png'\></a>
                        <a href='javascript:void(0);' title='Deletar' onclick='confirmDelete($v[id])'><img style='height: 20px; margin-right: 10px ;margin-top: 3px;' src='images/542724-9d1184b3.png'\></a>
                        </td>";
                      echo "<tr>";
                    }
                    ?>        
            </tbody>
          </table>

        </div>
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
  
</body></html>