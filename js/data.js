var data = new Date()
    
var dia = String(data.getDate()).padStart(2, '0')
var mes = String(data.getMonth() + 1).padStart(2, '0')
var ano = data.getFullYear()

var dataAtual = dia + '/' + mes + '/' + ano

var inputData = document.getElementById('current_time')
inputData.textContent = dataAtual
inputData.setAttribute('datetime', dataAtual)