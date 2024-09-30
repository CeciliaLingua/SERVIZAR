$(document).ready(function() {
    function toggleSidebar() {
        const $overlay = $('#overlay');
        const $sidebar = $('#navbar-vertical');
        
        if (!$overlay.length || !$sidebar.length) {
            console.error('Overlay o sidebar no encontrados');
            return;
        }

        console.log('Función toggleSidebar llamada');
        
        // Verifica el valor del display del overlay
        if ($overlay.css('display') === 'block') {
            $overlay.hide();
            $sidebar.css('right', '-300px');
        } else {
            $overlay.show();
            $sidebar.css('right', '0');
        }
    }

    // Opcional: Cierra la barra lateral cuando se hace clic en el overlay
    $('#overlay').click(function() {
        toggleSidebar();
    });
});
