<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Entradas</title>
    <style>
        /* Estructura de contenedor y fondo */
        .show-container {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .show-header {
            text-align: center;
            padding: 2rem;
            background-color: #343a40;
            color: white;
        }

        .show-content {
            display: flex;
            padding: 2rem;
            gap: 2rem;
            background-color: #fff;
        }

        .show-image {
            flex: 0 0 300px;
            border-radius: 4px;
            overflow: hidden;
        }

        .show-image img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        .show-details {
            flex: 1;
            color: #333;
        }

        .show-details h2 {
            margin: 0 0 1.5rem 0;
            color: #333;
            font-size: 1.8rem;
        }

        .show-info {
            margin-bottom: 1.5rem;
        }

        .show-info p {
            margin: 0.5rem 0;
            font-size: 1.1rem;
            color: #666;
        }

        .show-info strong {
            color: #333;
            margin-right: 0.5rem;
        }

        .show-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }

        /* Estilos para botones */
        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-dark {
            background-color: #343a40;
            color: #fff;
        }

        .btn-dark:hover {
            background-color: #23272b;
        }

        .btn-custom {
            background-color: rgba(52, 58, 64, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: rgba(52, 58, 64, 1);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* Fondo de la página */
        body {
            background-image: url('<?php echo base_url("assets/uploads/shows/fondo.png"); ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        /* Mensaje de éxito */
        .success-message {
            display: none; /* Oculto inicialmente */
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin: 1rem auto;
            max-width: 800px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="success-message" id="successMessage">
        Compra realizada con éxito
    </div>

    <div class="show-container">
        <div class="show-header">
            <h1>Comprar Entradas</h1>
        </div>
        
        <div class="show-content">
            <div class="show-image">
                <?php if (!empty($ticket->url)): ?>
                    <img src="<?php echo base_url($ticket->url); ?>" alt="Imagen del show">
                <?php else: ?>
                    <img src="<?php echo base_url('assets/uploads/shows/default.jpg'); ?>" alt="Imagen por defecto">
                <?php endif; ?>
            </div>
            
            <div class="show-details">
                <h2><?php echo htmlspecialchars($ticket->name); ?></h2>
                
                <div class="show-info">
                    <p><strong>Precio:</strong> $<?php echo number_format($ticket->price, 2); ?></p>
                    <p><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($ticket->date)); ?></p>
                    <p><strong>Entradas restantes:</strong> <?php echo $ticket->amount_available; ?></p>
                </div>
                
                <form action="<?php echo base_url('tickets/process_purchase/') . $ticket->idTicket; ?>" method="POST" id="purchaseForm">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad de entradas:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" 
                               max="<?php echo $ticket->amount_available; ?>" value="1" required>
                    </div>
                    
                    <div class="show-info mb-4">
                        <p><strong>Total a pagar:</strong> 
                            <span id="totalPrice">$<?php echo number_format($ticket->price, 2); ?></span>
                        </p>
                    </div>
                    
                    <div class="show-actions">
                        <a href="<?php echo base_url('tickets/show/') . $ticket->idTicket; ?>" class="btn btn-dark">Volver</a>
                        <button type="button" class="btn btn-custom" onclick="confirmPurchase()">Confirmar Compra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Actualiza el precio total en función de la cantidad seleccionada
document.getElementById('cantidad').addEventListener('change', function(e) {
    const cantidad = parseInt(e.target.value);
    const precio = <?php echo $ticket->price; ?>;
    const total = cantidad * precio;
    document.getElementById('totalPrice').textContent = '$' + total.toFixed(2);
});

// Función para confirmar la compra
function confirmPurchase() {
    const ticketName = "<?php echo htmlspecialchars($ticket->name); ?>";
    const cantidad = document.getElementById('cantidad').value;

    if (confirm(`¿Seguro que quieres comprar ${cantidad} entrada(s) para "${ticketName}"?`)) {
        document.getElementById('successMessage').style.display = 'block'; // Mostrar mensaje de éxito
        setTimeout(function() {
            document.getElementById('purchaseForm').submit(); // Enviar el formulario después del mensaje
        }, 1500); // Espera 1.5 segundos antes de enviar el formulario
    }
}
</script>

</body>
</html>
