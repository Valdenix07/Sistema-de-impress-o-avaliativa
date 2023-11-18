<?php 
    require('../backend/config.php');

    $id = filter_input(INPUT_GET, 'id');

    if($id){

      $sql = $conn->prepare("SELECT * FROM provas WHERE id=:id");
      $sql->bindValue(':id',$id);
      $sql->execute();

        if($sql->rowCount()>0){
            $edit = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
          header('Location: ../Tabela.php');
            exit;
        }

    } else {
      header('Location: ../Tabela.php');
        exit;
    }
?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="pt-br"><head>
    <title>Cadastrar</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Cadastrar.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <meta charset="utf-8"/>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
  
  </head>
  <body class="u-body u-overlap u-xl-mode" data-lang="pt">
    <section class="u-clearfix u-section-1" id="sec-9572">
      <div class="u-container-style u-custom-color-1 u-expanded-width u-group u-shape-rectangle u-group-1">
        <div class="u-container-layout u-valign-middle u-container-layout-1">
          <img class="u-image u-image-default u-image-1" src="images/0d258eff-d65a-4926-8f12-6056faed0be1.jfif" alt="" data-image-width="915" data-image-height="370">
        </div>
      </div>
      <h4 class="u-text u-text-default u-text-1">EDITAR</h4>
      <div class="u-expanded-width-xs u-form u-form-1">
        <form action="backend/provaedit.php" method="post" class="u-form-spacing-10 u-form-vertical u-inner-form" source="custom" name="form" style="padding: 10px;">
          <div class="u-form-group u-label-none u-form-group-1">
            <label for="text-b4ea" class="u-label u-text-palette-5-dark-1">Campo de Entrada</label>
            <input type="text" placeholder="Curso" id="text-b4ea" name="curso" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-1" required="required" autofocus="autofocus" value="<?=$edit['curso']?>">
          </div>
          <div class="u-form-group u-label-none u-form-group-2">
            <label for="text-c10e" class="u-label u-text-palette-5-dark-1">Campo de Entrada</label>
            <input type="text" placeholder="Professor" id="text-c10e" name="professor" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-2" required="required" value="<?=$edit['professor']?>">
          </div>
          <div class="u-form-group u-label-none u-form-group-3">
            <label for="text-a81c" class="u-form-control-hidden u-label u-text-palette-5-dark-1">0</label>
            <input type="text" id="text-a81c" name="disciplina" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-3" placeholder="Disciplina" required="required" value="<?=$edit['disciplina']?>">
          </div>
          <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-4">
            <label for="text-2de1" class="u-label u-text-palette-5-dark-1">Campo de Entrada</label>
            <input type="text" placeholder="Turma" id="text-2de1" name="turma" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-4" value="<?=$edit['turma']?>">
          </div>
          <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-5">
            <label for="text-aa01" class="u-label u-text-palette-5-dark-1">Campo de Entrada</label>
            <input type="text" placeholder="Turno" id="text-aa01" name="turno" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-5" required="required" value="<?=$edit['turno']?>">
          </div>
          <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-6">
            <label for="text-59cc" class="u-label u-text-palette-5-dark-1">Campo de Entrada</label>
            <input type="text" placeholder="Tipo de prova" id="text-59cc" name="tipo" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-6" value="<?=$edit['tipo']?>">
          </div>
          <div class="u-form-group u-form-partition-factor-2 u-label-none u-form-group-7">
            <label for="text-3fe7" class="u-label u-text-palette-5-dark-1">Campo de Entrada</label>
            <input type="text" placeholder="Data da prova" id="text-3fe7" name="data" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-7" value="<?=$edit['dataprova']?>">
          </div>
          <div class="u-form-group u-form-partition-factor-3 u-label-none u-form-group-8">
            <label for="text-eb46" class="u-label u-text-palette-5-dark-1">Campo de Entrada</label>
            <input type="text" placeholder="Quantidade de folhas" id="text-eb46" name="folhas" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-8" required="required" value="<?=$edit['qtdfolhas']?>">
          </div>
          <div class="u-form-group u-form-partition-factor-3 u-form-select u-label-none u-form-group-9">
            <label for="select-118b" class="u-label u-text-palette-5-dark-1">Dropdown</label>
            <div class="u-form-select-wrapper">
              <select id="select-118b" name="situacao" class="u-border-2 u-border-grey-30 u-input u-input-rectangle u-text-palette-5-dark-1 u-white">
                <option value="Recebida">Recebida</option>
                <option value="Impressa">Impressa</option>
                <option value="Entregue">Entregue</option>
                <option value="Devolvida">Devolvida</option>
              </select>
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
            </div>
          </div>
          <div class="u-form-group u-form-partition-factor-3 u-label-none u-form-group-10">
            <label for="text-455d" class="u-label u-text-palette-5-dark-1">Campo de Entrada</label>
            <input type="text" placeholder="Data da situação" id="text-455d" name="datasitu" class="u-border-2 u-border-no-left u-border-no-right u-border-no-top u-border-palette-1-dark-1 u-input u-input-rectangle u-text-palette-5-dark-1 u-input-10" value="<?=$edit['datasituacao']?>">
          </div>

          <input type="hidden" name="id" value="<?=$edit['id']?>">

          <div class="u-align-center u-form-group u-form-submit u-label-none">
            <input type="submit" value="Salvar" name="update" href="#" class="u-border-none u-btn u-btn-round u-btn-submit u-button-style u-palette-1-dark-1 u-radius-4 u-btn-1">
            
          </div>  
        </form>
      </div>
    </section>
    
</body></html>