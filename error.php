<?php
// Comprobar si hay un mensaje de error a mostrar
if (isset($error_message) && !empty($error_message)) {
    ?>
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Error</h2>
            <p><?php echo htmlspecialchars($error_message); ?></p>
        </div>
    </div>

    <style>
        /* Estilos del modal */
        .modal {
            display: block; /* Mostrar el modal automáticamente si hay error */
            position: fixed;
            z-index: 1000;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background-color: Red;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            padding: 20px;
            text-align: center;
            color: white;
        }

        .close-btn {
            color: #fff;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* Fondo oscuro que cubre toda la página */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 999;
        }
    </style>

    <script>
        // Obtener el modal y el botón de cerrar
        var modal = document.getElementById("errorModal");
        var closeBtn = document.querySelector(".close-btn");

        // Cuando el usuario hace clic en el botón de cerrar, oculta el modal
        closeBtn.onclick = function() {
            window.history.back();
        }

        // También puedes cerrar el modal si el usuario hace clic fuera de él
        window.onclick = function(event) {
            if (event.target == modal) {
                window.history.back();
            }
        }
    </script>
    <?php
}
?>
