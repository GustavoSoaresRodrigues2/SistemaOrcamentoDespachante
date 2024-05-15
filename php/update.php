<?php

    include('conexao.php');

    date_default_timezone_set('America/Sao_Paulo');

    $hoje = date('d/m/Y');
    $id = htmlspecialchars($_POST['id']);
    $tipoOrcamento = htmlspecialchars($_POST['tipoOrcamento']);
    $solicitante = htmlspecialchars($_POST['solicitante']);
    $placa = htmlspecialchars($_POST['placa']);
    $renavam = htmlspecialchars($_POST['renavam']);
    $veiculo = htmlspecialchars($_POST['veiculo']);
    $tipoCusto = $_POST['tipoCusto'];
    $valorCusto = $_POST['valorCusto'];

    try {
        if (empty($tipoOrcamento) || empty($solicitante) || empty($placa) || empty($renavam) || empty($veiculo)) {
            echo "<script>alert('Preencha todos os dados para consultar!'); window.location.href = '../index.php';</script>";
            exit; // Encerrar a execução do script
        }

        $custos = array();

        if (count($tipoCusto) == count($valorCusto)) {
            // Percorre os arrays e agrupa os valores correspondentes em um array associativo
            for ($i = 0; $i < count($tipoCusto); $i++) {
                if (empty($tipoCusto[$i]) || empty($valorCusto[$i])) {
                    echo "<script>alert('Preencha todos os dados para consultar!'); window.location.href = '../index.php';</script>";
                    exit; // Encerrar a execução do script
                }
                // Aplica htmlspecialchars em cada elemento dos arrays
                $tipoCusto[$i] = htmlspecialchars($tipoCusto[$i]);
                $valorCusto[$i] = htmlspecialchars($valorCusto[$i]);
                // Adiciona um trio ao array associativo
                $custos[$tipoCusto[$i]] = $valorCusto[$i];
            }
        }
        // Serializa o array associativo $custos para uma string
        $custos_serializados = serialize($custos);

        $stmt = $conexao->prepare("UPDATE orcamento SET dia = ?, tipo_orcamento = ?, solicitante = ?, placa = ?, renavam = ?, veiculo = ?, servicos = ? WHERE id = ?");
        $stmt->execute([$hoje, $tipoOrcamento, $solicitante, $placa, $renavam, $veiculo, $custos_serializados, $id]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Registro atualizado com sucesso'); window.location.href = '../index.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar registro ou Nenhum campo foi atualizado.'); window.location.href = '../index.php';</script>";
        }
    } catch (\Throwable $th) {
        
    }
?>
