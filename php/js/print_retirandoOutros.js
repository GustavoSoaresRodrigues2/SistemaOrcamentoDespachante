
function printTirandoOutros(mainPrincipal) {
    var mains = document.querySelectorAll('main');

    for (let i = 1; i <= mains.length; i++) {
        var main = document.getElementById('num' + i)

        if (main) {
            if (main.getAttribute('id') !== mainPrincipal) {
                main.style.display = 'none'
            }
        }
    }

    var mainPai = document.getElementById(mainPrincipal)
    var Btns = mainPai.querySelector('#buttons')
    Btns.classList.remove('manifest')
    Btns.classList.add('hidden')
    
    setTimeout(() => {
        window.print()
        Btns.classList.remove('hidden')
        Btns.classList.add('manifest')
    }, 1000);
}



