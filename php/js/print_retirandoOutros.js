function printTirandoOutros(mainPrincipal) {
    
    var mains = document.querySelectorAll('main')


    for (let i = 0; i < mains.length; i++) {
        var mains = document.getElementById('#num' + i);

        // Percorre todas as mains
        mains.forEach(function(main) {
            // Verifica se a main atual é diferente da mainPrincipal
            if (main !== mainPrincipal) {
                // Esconde a main atual se for diferente da mainPrincipal
                main.style.display = 'none';
            } else {
                console.log("dgsdg")
            }
        });
    }
}
