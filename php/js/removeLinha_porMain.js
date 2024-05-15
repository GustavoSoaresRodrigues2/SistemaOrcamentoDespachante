function removeLinha_porMain(section) {
    var valorOrcamento = document.getElementById(section)
    var inputs = valorOrcamento.querySelectorAll('input[type="text"], input[type="number"]')

    if (inputs.length > 4) {
        valorOrcamento.removeChild(inputs[inputs.length - 2])
        valorOrcamento.removeChild(inputs[inputs.length - 1])
    }

    somaValores(section)
}