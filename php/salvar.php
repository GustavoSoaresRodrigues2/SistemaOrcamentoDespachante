<?php

    include('conexao.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        date_default_timezone_set('America/Sao_Paulo');
        
        $hoje = date('d/m/Y');
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

            $stmt = $conexao->prepare("INSERT INTO orcamento (dia, tipo_orcamento, solicitante, placa, renavam, veiculo, servicos) VALUES (?, ?, ?, ?, ?, ?, ?)");

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

            if ($stmt) {
                $stmt->bindParam(1, $hoje);
                $stmt->bindParam(2, $tipoOrcamento);
                $stmt->bindParam(3, $solicitante);
                $stmt->bindParam(4, $placa);
                $stmt->bindParam(5, $renavam);
                $stmt->bindParam(6, $veiculo);
                $stmt->bindParam(7, $custos_serializados);

                $stmt->execute();

                if($stmt->rowCount() > 0) {
                    echo "<script>alert('Registro inserido com sucesso.');
                        window.location.href = '../index.php';</script>";
                } else {
                    echo "Erro ao inserir registro";
                }
            } else {
                echo "Erro na preparação da declaração";
            }

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        $conexao = null;
    }
?>
