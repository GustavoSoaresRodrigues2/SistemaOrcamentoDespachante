const containers = document.querySelectorAll('.container');
let isDragging = false;
let offsetX, offsetY, currentContainer;

containers.forEach(container => {
    const handle = container.querySelector('.icon-mover');

    handle.addEventListener('mousedown', (e) => {
        isDragging = true;
        currentContainer = container;
        offsetX = e.clientX - currentContainer.getBoundingClientRect().left;
        offsetY = e.clientY - currentContainer.getBoundingClientRect().top;
        e.stopPropagation();
    });
});

document.addEventListener('mousemove', (e) => {
    if (isDragging && currentContainer) {
        let newLeft = e.clientX - offsetX;
        let newTop = e.clientY - offsetY;

        // Obter limites de main
        const mainRect = document.querySelector('main').getBoundingClientRect();
        const containerRect = currentContainer.getBoundingClientRect();

        // Restrições para manter o container dentro de main
        if (newLeft < mainRect.left) {
            newLeft = mainRect.left;
        }
        if (newLeft + containerRect.width > mainRect.right) {
            newLeft = mainRect.right - containerRect.width;
        }
        if (newTop < mainRect.top) {
            newTop = mainRect.top;
        }
        if (newTop + containerRect.height > mainRect.bottom) {
            newTop = mainRect.bottom - containerRect.height;
        }

        // Verificação de sobreposição com outros contêineres
        containers.forEach(otherContainer => {
            if (otherContainer !== currentContainer) {
                const otherRect = otherContainer.getBoundingClientRect();

                // Verifica se há sobreposição
                if (
                    newLeft < otherRect.right &&
                    newLeft + containerRect.width > otherRect.left &&
                    newTop < otherRect.bottom &&
                    newTop + containerRect.height > otherRect.top
                ) {
                    // Ajusta a posição para evitar sobreposição
                    if (newTop < otherRect.bottom && newTop + containerRect.height > otherRect.top) {
                        newTop = otherRect.top - containerRect.height; // Move acima
                    } else if (newTop + containerRect.height > otherRect.top && newTop < otherRect.bottom) {
                        newTop = otherRect.bottom; // Move abaixo
                    }
                }
            }
        });

        currentContainer.style.left = `${newLeft - mainRect.left}px`;
        currentContainer.style.top = `${newTop - mainRect.top}px`;
    }
});

document.addEventListener('mouseup', () => {
    isDragging = false;
    currentContainer = null;
});

// Ajusta a posição da bola ao carregar a página
function updateHandlePosition() {
    containers.forEach(container => {
        const input = container.querySelector('.input-movel');
        const handle = container.querySelector('.icon-mover');

        handle.style.left = `${input.getBoundingClientRect().right + window.scrollX}px`;
        handle.style.top = `${input.getBoundingClientRect().top + window.scrollY}px`;
    });
}

// Chama a função para posicionar a bola ao carregar a página
window.onload = updateHandlePosition;
// Chama a função quando a janela é redimensionada
window.onresize = updateHandlePosition;
