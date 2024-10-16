document.querySelectorAll('.icon-mover').forEach((icon) => {
    icon.addEventListener('mousedown', function (e) {
        const container = this.parentElement;
        const main = document.querySelector('main');
        const mainRect = main.getBoundingClientRect();
        let shiftX = e.clientX - container.getBoundingClientRect().left;
        let shiftY = e.clientY - container.getBoundingClientRect().top;

        const moveAt = (pageX, pageY) => {
            // Limitar dentro do main
            let newLeft = pageX - shiftX;
            let newTop = pageY - shiftY;

            // Impedir que o input saia dos limites horizontais
            if (newLeft < mainRect.left) {
                newLeft = mainRect.left;
            }
            if (newLeft + container.offsetWidth > mainRect.right) {
                newLeft = mainRect.right - container.offsetWidth;
            }

            // Impedir que o input saia dos limites verticais
            if (newTop < mainRect.top) {
                newTop = mainRect.top;
            }
            if (newTop + container.offsetHeight > mainRect.bottom) {
                newTop = mainRect.bottom - container.offsetHeight;
            }

            container.style.left = newLeft + 'px';
            container.style.top = newTop + 'px';
        };

        const onMouseMove = (event) => {
            moveAt(event.pageX, event.pageY);
            checkForOverlap();
        };

        document.addEventListener('mousemove', onMouseMove);

        container.onmouseup = function () {
            document.removeEventListener('mousemove', onMouseMove);
            container.onmouseup = null;
        };
    });

    icon.ondragstart = function () {
        return false;
    };
});

function checkForOverlap() {
    const containers = document.querySelectorAll('.container');
    containers.forEach((container, index) => {
        containers.forEach((otherContainer, otherIndex) => {
            if (index !== otherIndex && isOverlapping(container, otherContainer)) {
                container.style.top = parseInt(container.style.top) + 50 + 'px'; // Ajusta a posição
            }
        });
    });
}

function isOverlapping(element1, element2) {
    const rect1 = element1.getBoundingClientRect();
    const rect2 = element2.getBoundingClientRect();

    return !(rect1.right < rect2.left ||
        rect1.left > rect2.right ||
        rect1.bottom < rect2.top ||
        rect1.top > rect2.bottom);
}
