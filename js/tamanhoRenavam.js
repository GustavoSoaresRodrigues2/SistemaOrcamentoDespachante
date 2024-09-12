document.addEventListener('DOMContentLoaded', function () {    
    var inputElement = document.getElementById('renavam')
    
    inputElement.addEventListener('input', function () {
        if (this.value.length > this.maxLength) {
            this.value = this.value.slice(0, this.maxLength)
        }
    })
})

var btnExtrato = document.getElementById('extratoValores')

btnExtrato.addEventListener('click', function () {
    window.location.href = 'php/extratoValores.php'
})