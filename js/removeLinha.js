var btnRemoveLinha = document.getElementById('removeLinha')

btnRemoveLinha.addEventListener('click', function() {
    var valorOrcamento = document.getElementById('valorOrcamento')
    var inputs = valorOrcamento.querySelectorAll('input[type="text"], input[type="number"]')
    
    if (inputs.length > 4) {
        valorOrcamento.removeChild(inputs[inputs.length - 2])
        valorOrcamento.removeChild(inputs[inputs.length - 1])
    }

    somaValores()
})