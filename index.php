<?php

    include('php/conexao.php');

    $query = "SELECT MAX(id) AS max_id FROM orcamento";

    $stmt = $conexao->prepare($query);

    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $max_id = $resultado['max_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamentos</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body id="body">
    <header id="header" class="hidden">
        <h1>Controles</h1>
        <nav id="nav">
            <div>
                <button type="button" class="btn" id="addLinha">
                    Adicionar Linha
                </button>

                <button type="button" class="btn" id="removeLinha">
                    Remover Linha
                </button>
            </div>

            <div>
                <form action="php/consultar.php" method="post" id="consultar">
                    <input type="text" class="placa" id="placa" name="placa" maxlength="7" placeholder="Placa do Veículo...">
                    ou
                    <input type="date" class="date" id="date" name="date">

                    <button type="submit" class="btn" id="">
                        Consultar Orçamento
                    </button>
                </form>
            </div>

            <button type="button" class="btn" id="">
                Extrato de Valores
            </button>
        </nav>
    </header>

    <div id="controlMenu">
        <label class="labelControl" for="inputControl">
            <input type="checkbox" id="inputControl">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <main>
        <figure>
            <img src="img/sagg_logo_semFundo.jpg" alt="Logo SAGG Despachante" class="logo">
        </figure>
        <form action="php/salvar.php" method="post" id="salvar">
            <hr>
            <section>
                <label for="tipoOrcamento">
                    Orçamento de
                </label>    <input list="lista_orcamento" class="tipoOrcamento" id="tipoOrcamento" name="tipoOrcamento" maxlength="100" required>
            </section>

            <hr>

            <section>
                <article>
                    Informações abaixo conforme pesquisa realizada em <time date="" id="current_time"></time>.
                </article>
                <article>
                    Orçamento nº <?php echo $max_id + 1; ?>
                </article>
            </section>

            <hr>

            <section>
                <label for="solicitante">
                    Solicitante: 
                </label>    <input type="text" class="solicitante" id="solicitante" name="solicitante" maxlength="100" required>

                <label for="placa">
                    Placa:
                </label>    <input type="text" class="placa" id="placa" name="placa" maxlength="7" required>

                <label for="renavam">
                    Renavam:
                </label>    <input type="number" class="renavam" id="renavam" name="renavam" maxlength="11" required>
                
                <label for="veiculo">
                    Veículo: 
                </label>    <input type="text" class="veiculo" id="veiculo" name="veiculo" maxlength="100" required>
            </section>

            <hr>

            <section id="valorOrcamento">
                <input type="text" class="tipoCusto" id="tipoCusto" name="tipoCusto[]" list="lista_custos" required>

                <input type="number" class="valorCusto" id="valorCusto" name="valorCusto[]" step="0.01" required>

                <input type="text" class="tipoCusto" id="tipoCusto" name="tipoCusto[]" list="lista_custos" required>

                <input type="number" class="valorCusto" id="valorCusto" name="valorCusto[]" step="0.01" required>

                <p>Custos</p>
                <p class="total">Valor Total: R$ 0,00</p>
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
            
            <section id="buttons" class="manifest">
                <button type="button" class="btn" id="print">
                    Print
                </button>

                <button type="submit" class="btn" id="">
                    Salvar
                </button>
            </section>
        </form>
    </main>
    <footer>
        Feito por Gustavo Soares Rodrigues - &#169;Copyright 2024. <a href="https://github.com/GustavoSoaresRodrigues2/SistemaOrcamentoDespachante.git" target="_blank"><i class="fa fa-github" style="font-size:24px"></i></a>
    </footer>

    <datalist id="lista_orcamento">
        <option value="Licenciamento"></option>
        <option value="Transferência de Propriedade"></option>
        <option value="2° Via de DUT"></option>
        <option value="2° Via Placa Mercosul"></option>
        <option value="Débitos"></option>
    </datalist>
    <datalist id="lista_custos">
        <option value="Taxas Detran"></option>
        <option value="IPVA"></option>
        <option value="IPVA Divida Ativa"></option>
        <option value="Licenciamento"></option>
        <option value="Multas (00)"></option>
        <option value="Placa Mercosul - Confeccao / Instalacao"></option>
        <option value="2° Via Placa Mercosul - Confeccao / Instalacao"></option>
        <option value="Honorarios"></option>
    </datalist>
    <script src="js/data.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/print.js"></script>
    <script src="js/tamanhoRenavam.js"></script>
    <script src="js/addLinha.js"></script>
    <script src="js/removeLinha.js"></script>
    <script src="js/somaValores.js"></script>
</body>
</html>