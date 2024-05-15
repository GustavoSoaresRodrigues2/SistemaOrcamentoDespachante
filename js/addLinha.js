function removeE() {
    var numberInputs = document.querySelectorAll('input[type="number"]')

    numberInputs.forEach(function(input) {
        input.addEventListener('keydown', function(event) {
            if (event.key === 'e' || event.key === 'E') {
                event.preventDefault()
            }
        })
    })
}

removeE()

var btnAddLinha = document.getElementById('addLinha')

btnAddLinha.addEventListener('click', function() {
    var novoInputTipoCusto = document.createElement('input')
    novoInputTipoCusto.setAttribute('type', 'text')
    novoInputTipoCusto.classList.add('tipoCusto')
    novoInputTipoCusto.setAttribute('id', 'tipoCusto')
    novoInputTipoCusto.setAttribute('name', 'tipoCusto[]')
    novoInputTipoCusto.setAttribute('list', 'lista_custos')
    novoInputTipoCusto.setAttribute('required', 'required')

    var novoInputValorCusto = document.createElement('input')
    novoInputValorCusto.setAttribute('type', 'number')
    novoInputValorCusto.classList.add('valorCusto')
    novoInputValorCusto.setAttribute('id', 'valorCusto')
    novoInputValorCusto.setAttribute('name', 'valorCusto[]')
    novoInputValorCusto.setAttribute('step', '0.01')
    novoInputValorCusto.setAttribute('required', 'required')

    var P__ValorTotal = document.getElementById('valorOrcamento').querySelectorAll('p')

    var section = document.getElementById('valorOrcamento')
    section.insertBefore(novoInputValorCusto, P__ValorTotal[0])
    section.insertBefore(novoInputTipoCusto, novoInputValorCusto)

    removeE()
    adicionarOuvinteInputsPreco()
})
