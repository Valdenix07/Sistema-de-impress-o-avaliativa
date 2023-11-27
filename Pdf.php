<?php
require('../backend/Config.php');
require('../impressao1/fpdf186/fpdf.php');

function drawTableHeader($pdf)
{
    $pdf->Ln(10); // Adiciona um espaço entre a data e a tabela
    $pdf->SetFillColor(34, 50, 102); // Define a cor de fundo como #223266
    $pdf->SetTextColor(255, 255, 255); // Define a cor do texto como branco
    $pdf->Cell(35, 10, utf8_decode('CURSO'), 1, 0, 'C', 1); // '1' ativa o preenchimento
    $pdf->Cell(35, 10, utf8_decode('DISCIPLINA'), 1, 0, 'C', 1);
    $pdf->Cell(35, 10, utf8_decode('PROFESSOR'), 1, 0, 'C', 1);
    $pdf->Cell(23, 10, utf8_decode('TIPO'), 1, 0, 'C', 1);
    $pdf->Cell(20, 10, utf8_decode('TURMA'), 1, 0, 'C', 1);
    $pdf->Cell(20, 10, utf8_decode('TURNO'), 1, 0, 'C', 1);
    $pdf->Cell(30, 10, utf8_decode('DATA PROVA'), 1, 0, 'C', 1);
    $pdf->Cell(20, 10, utf8_decode('COPIAS'), 1, 0, 'C', 1);
    $pdf->Cell(25, 10, utf8_decode('SITUAÇÃO'), 1, 0, 'C', 1);
    $pdf->Cell(35, 10, utf8_decode('DATA SITUAÇÃO'), 1, 1, 'C', 1); // '1' ativa o preenchimento e indica nova linha
    $pdf->SetTextColor(0, 0, 0); // Redefine a cor do texto para preto
}

function drawTableRow($pdf, $row)
{
    $pdf->Cell(35, 10, utf8_decode($row["curso"]), 1, 0, 'C'); // 'C' define o alinhamento central
    $pdf->Cell(35, 10, utf8_decode($row["disciplina"]), 1, 0, 'C');
    $pdf->Cell(35, 10, utf8_decode($row["professor"]), 1, 0, 'C');
    $pdf->Cell(23, 10, utf8_decode($row['tipo']), 1, 0, 'C');
    $pdf->Cell(20, 10, utf8_decode($row['turma']), 1, 0, 'C');
    $pdf->Cell(20, 10, utf8_decode($row['turno']), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($row['dataprova']), 1, 0, 'C');
    $pdf->Cell(20, 10, utf8_decode($row['qtdfolhas']), 1, 0, 'C');
    $pdf->Cell(25, 10, utf8_decode($row['situacao']), 1, 0, 'C');
    $pdf->Cell(35, 10, utf8_decode($row['datasituacao']), 1, 1, 'C'); // '1' ativa o preenchimento e indica nova linha
}

function drawTableForSituation($pdf, $conn, $situacao)
{
    // Consulta para obter os dados específicos para cada situação
    $stmt = $conn->prepare("SELECT * FROM provas WHERE situacao = :situacao");
    $stmt->bindParam(':situacao', $situacao);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se há provas para a situação
    if (count($result) > 0) {
        // Adiciona uma nova página
        $pdf->AddPage();
        
        // Título da tabela específica
        $pdf->SetFont('Helvetica', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode('Relatório de Avaliações - ' . $situacao), 0, 1, 'C');
        $pdf->SetFont('Helvetica', '', 10);

        // Cabeçalho da tabela específica
        drawTableHeader($pdf);

        // Dados da tabela específica com caracteres especiais tratados
        foreach ($result as $row) {
            if ($pdf->GetY() + 10 > 210) {
                $pdf->AddPage();
                drawTableHeader($pdf);
            }
            drawTableRow($pdf, $row);
        }

        // Adiciona uma linha com a soma da coluna "copias" para a tabela específica
        $somaCopias = array_sum(array_column($result, 'qtdfolhas'));
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('Folhas utilizadas: ' . $somaCopias), 0, 1, 'C');
    }
}

try {
    $stmt = $conn->prepare("SELECT * FROM provas");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crie um objeto FPDF com orientação paisagem
    $pdf = new FPDF('L', 'mm', 'A4'); // 'L' define paisagem
    $pdf->SetDrawColor(34, 50, 102); // Define a cor da linha como #223266

    // Defina a fonte como "Helvetica" e o tamanho da fonte
    $pdf->SetFont('Helvetica', '', 10);

    // Título do relatório
    $pdf->AddPage(); // Adiciona a primeira página
    $pdf->SetFont('Helvetica', 'B', 16); // Aumenta o tamanho da fonte e torna negrito
    $pdf->Cell(0, 10, utf8_decode('Relatório de Avaliações'), 0, 1, 'C'); // Título sem fundo
    $pdf->SetFont('Helvetica', '', 10); // Redefine o tamanho e estilo da fonte

    // Data atual
    $pdf->Cell(0, 10, utf8_decode('Data: ' . date('d/m/Y')), 0, 1, 'C'); // Exibe a data atual centralizada
    $pdf->Ln(10); // Adiciona um espaço entre a data e a tabela

    // Cabeçalho da tabela principal
    drawTableHeader($pdf);

    // Dados da tabela principal com caracteres especiais tratados
    foreach ($result as $row) {
        if ($pdf->GetY() + 10 > 210) { // Verifica se há espaço na página
            $pdf->AddPage(); // Cria uma nova página
            // Redefina o cabeçalho da tabela principal com cores personalizadas
            drawTableHeader($pdf);
        }
        drawTableRow($pdf, $row);
    }

    // Adiciona uma linha com a soma da coluna "copias"
    $somaCopias = array_sum(array_column($result, 'qtdfolhas'));
    $pdf->Ln(10); // Adiciona um espaço antes da linha da soma
    $pdf->Cell(0, 10, utf8_decode('Folhas utilizadas: ' . $somaCopias), 0, 1, 'C'); // Exibe a soma da coluna "copias" centralizada

    // Tabelas para cada situação específica
    $situacoes = array('Recebida', 'Impressa', 'Entregue', 'Devolvida'); // Adicione as situações desejadas
    foreach ($situacoes as $situacao) {
        drawTableForSituation($pdf, $conn, $situacao);
    }

    // Saída do PDF para o navegador
    $pdf->Output();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
