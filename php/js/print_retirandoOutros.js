
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

    var buttons = document.querySelectorAll('#buttons');

    buttons.forEach(function() {
        buttons.setAttribute('class', '');
    });


    // Btns.classList.add('hidden')
    // setTimeout(() => {
    //     window.print()
    // }, 1000);
    
}



