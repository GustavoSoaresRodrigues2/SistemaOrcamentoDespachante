var btnPrint = document.getElementById('print')

btnPrint.addEventListener('click', function () {
    var Btns = document.querySelector('#buttons')
    Btns.classList.remove('manifest')
    Btns.classList.add('hidden')

    setTimeout(() => {
        window.print()
        Btns.classList.remove('hidden')
        Btns.classList.add('manifest')
    }, 100);
})