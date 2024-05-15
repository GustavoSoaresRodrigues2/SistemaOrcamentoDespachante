document.addEventListener('DOMContentLoaded', function () {    
    var inputElement = document.getElementById('renavam')
    
    inputElement.addEventListener('input', function () {
        if (this.value.length > this.maxLength) {
            this.value = this.value.slice(0, this.maxLength)
        }
    })

    var btnPrint = document.getElementById('print')

    btnPrint.addEventListener('click', function() {
        var Btns = document.querySelector('#buttons')
        Btns.classList.remove('manifest')
        Btns.classList.add('hidden')
        
        setTimeout(() => {
            window.print()
            Btns.classList.remove('hidden')
            Btns.classList.add('manifest') 
        }, 100);  
    })
})

