<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterando Orçamento</title>

    <link rel="stylesheet" href="../style.css">
</head>
<body id="body">
    <header id="header" class="hidden">
        <h1>Controles</h1>
        <nav id="nav">
            <button type="button" class="btn" id="irIndex">
                Fazer Orçamento
            </button>

            <div>
                <form action="" method="post" id="consultar">
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