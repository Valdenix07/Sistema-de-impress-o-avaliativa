<?php
require('./backend/Config.php');

try {
    $stmt = $conn->prepare("SELECT * FROM provas WHERE LOWER(situacao) = 'devolvida'");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
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
    <title>Relatorio</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Tabela.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.18.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    
   
  </head>
  <body class="u-body u-custom-color-3 u-xl-mode" data-lang="pt">
    <section class="u-clearfix u-section-1" id="sec-f057">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-custom-color-1 u-shape u-shape-rectangle u-shape-1"></div>
        <img class="u-image u-image-default u-image-1" src="images/0d258eff-d65a-4926-8f12-6056faed0be1.jfif" alt="" data-image-width="915" data-image-height="370">
        <a href="Tabela.php" class="u-border-none u-btn u-button-style u-custom-color-1 u-btn-1">Voltar</a>
        <div class="u-expanded-width-lg u-expanded-width-sm u-expanded-width-xl u-expanded-width-xs u-table u-table-responsive u-table-1">
          <table id="myTable" class="table table-striped table-bordered border border-secondary">
            <thead class="u-align-center u-custom-color-1 u-table-header u-table-header-1">
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
            <tbody class="u-align-center u-table-body">
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
                      <a href='../paginas/edit_usuario.php?id=$v[id]' title='Editar'><img style='height: 28px; margin-right: 10px ;margin-top: 3px;' src='images/1828911-ec0d8d30.png'\></a>
                        <a href='backend/provadelete.php?id=$v[id]' title='Deletar'><img style='height: 28px; margin-right: 10px ;margin-top: 3px;' src='images/542724-9d1184b3.png'\></a>
                        </td>";
                        echo "<tr>";
                    }
                    ?>        
            </tbody>
          </table>

        </div>
      </div>
      
      
      
      
      
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/  1.13.6/js/jquery.dataTables.js"></script>
       
   
  
</body></html>