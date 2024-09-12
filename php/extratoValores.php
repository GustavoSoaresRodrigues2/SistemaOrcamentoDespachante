<?php

    include('conexao.php');

    try {
        $query = 'SELECT servicos FROM orcamento';
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

?>