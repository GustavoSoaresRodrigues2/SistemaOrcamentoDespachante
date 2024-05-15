<?php

    include('conexao.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $placa = $_POST['placa'];
        $data = $_POST['date'];

        $data_formatada = date('d/m/Y', strtotime($data));
        
        if (empty($placa) && empty($data)) {
            echo "<script>alert('Preencha algum dado para consultar!'); window.location.href = '../index.php';</script>";
            exit; // Encerrar a execução do script
        }

        try {
            $query = 'SELECT * FROM orcamento WHERE 1';

            // Adicionar cláusulas WHERE conforme necessário
            $params = array();

            if (!empty($placa)) {
                $query .= " AND placa = :placa";
                $params['placa'] = $placa;
            }
            if (!empty($data)) {
                $query .= " AND dia = :data";
                $params['data'] = $data_formatada;
            }

            $stmt = $conexao->prepare($query);
            $stmt->execute($params);

            if ($stmt->rowCount() > 0) {

                include('html/header.php');
                
                $cont = 1;

                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <main onmousemove=\"adicionarOuvinteInputsPreco('valorOrcamento" . $cont . "')\">
                        <figure>
                            <img src='../img/sagg_logo_semFundo.jpg' alt='Logo SAGG Despachante' class='logo'>
                        </figure>
                        <form action='update.php' method='post' id='salvar'>
                            <hr>
                            <section>
                                <label for='tipoOrcamento'>
                                    Orçamento de
                                </label>    <input value='" . $linha['tipo_orcamento'] . "' list='lista_orcamento' class='tipoOrcamento' id='tipoOrcamento' name='tipoOrcamento' maxlength='100' required>
                            </section>

                            <hr>

                            <section>
                                <article>
                                    Informações abaixo conforme pesquisa realizada em " . $linha['dia'] . ".
                                </article>
                                <article id='numOrcamento'>
                                    Orçamento nº " . $linha['id'] . "
                                    <input type='hidden' value='" . $linha['id'] . "' name='id'>
                                </article>
                            </section>

                            <hr>

                            <section>
                                <label for='solicitante'>
                                    Solicitante: 
                                </label>    <input value='" . $linha['solicitante'] . "' type='text' class='solicitante' id='solicitante' name='solicitante' maxlength='100' required>

                                <label for='placa'>
                                    Placa:
                                </label>    <input value='" . $linha['placa'] . "' type='text' class='placa' id='placa' name='placa' maxlength='7' required>

                                <label for='renavam'>
                                    Renavam:
                                </label>    <input value='" . $linha['renavam'] . "' type='number' class='renavam' id='renavam' name='renavam' maxlength='11' required>
                                
                                <label for='veiculo'>
                                    Veículo: 
                                </label>    <input value='" . $linha['veiculo'] . "' type='text' class='veiculo' id='veiculo' name='veiculo' maxlength='100' required>
                            </section>

                            <hr>
                            
                            <section id='valorOrcamento" . $cont . "'>";

                            $custos_deserializados = unserialize($linha['servicos']);
                            foreach ($custos_deserializados as $tipoCusto => $valorCusto) {
                                echo "
                                    <input value='" . $tipoCusto . "' type='text' class='tipoCusto' id='tipoCusto' name='tipoCusto[]' list='lista_custos' required>

                                    <input value='" . $valorCusto . "' type='number' class='valorCusto' id='valorCusto' name='valorCusto[]' step='0.01' required>
                                ";
                            }

                            echo "
                                <p>Custos</p>
                                <p class='total'>Valor Total: R$ 0,00</p>
                            </section>

                            <hr>

                            <section>
                                <article>
                                    Para pagamentos via cartão de crédito á vista ou parcelado, consulte condições.
                                </article>
                                <article>
                                    Parcelamos em até 12x no cartão de crédito, mediante juros administrativos do Banco.
                                </article>
                            </section>

                            <hr>

                            <section id='buttons' class='manifest'>
                                <button type='submit' class='btn' id=''>
                                    Alterar
                                </button>

                                <button type='button' class='btn' id='addLinha' onclick=\"addLinha_porMain('valorOrcamento" . $cont . "')\">
                                    Adicionar Linha
                                </button>

                                <button type='button' class='btn' id='removeLinha' onclick=\"removeLinha_porMain('valorOrcamento" . $cont . "')\">
                                    Remover Linha
                                </button>
            
                            </section>
                        </form>
                    </main>
                    ";

                    $cont += 1;
                }
                include('html/footer.php'); 
            } else {
                echo "<script>alert('Nenhum resultado encontrado!'); window.location.href = '../index.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
?>