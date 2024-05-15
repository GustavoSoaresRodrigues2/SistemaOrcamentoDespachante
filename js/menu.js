document.getElementById('inputControl').addEventListener('change', function() {
    var menu = document.getElementById('header')

    if (this.checked) {
        menu.classList.remove('hidden')
        menu.classList.add('manifest')
    } else {
        menu.classList.remove('manifest')
        menu.classList.add('hidden')
    } 
})