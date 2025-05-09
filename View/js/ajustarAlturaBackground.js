    function ajustarAlturaBackground() {
    var body = document.body;
    var html = document.documentElement;

    var height = Math.max(
        body.offsetHeight,
        html.clientHeight,
        html.offsetHeight
    );

    document.getElementById('background').style.height = height.toString() + "px";
}

// Adicionar listeners para redimensionamento e rolagem
window.addEventListener('resize', ajustarAlturaBackground);
window.addEventListener('scroll', ajustarAlturaBackground);
window.addEventListener('zoom', ajustarAlturaBackground);