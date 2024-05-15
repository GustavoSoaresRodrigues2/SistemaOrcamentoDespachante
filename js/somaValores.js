function adicionarOuvinteInputsPreco() {
    var valorOrcamento = document.getElementById('valorOrcamento')
    valorOrcamento.querySelectorAll('.valorCusto').forEach(function(input) {
        input.addEventListener('input', somaValores)
    })
}

function somaValores() {
    var inputsPrecos = document.querySelectorAll('#valorOrcamento .valorCusto')
    var soma = 0

    inputsPrecos.forEach(function(input) {
        var valor = parseFloat(input.value)
        soma += isNaN(valor) ? 0 : valor
    })

    var P__printSoma = document.querySelector('.total')
    if (P__printSoma) {
        P__printSoma.textContent = "Valor Total: R$ " + formatarValor(soma)
    }
}

function formatarValor(numero) {
    return numero.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}

adicionarOuvinteInputsPreco()