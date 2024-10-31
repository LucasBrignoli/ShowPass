<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Entradas</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/compra.css'); ?>">
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
                    <p><strong>Hora:</strong> <?php echo date('H:i', strtotime($ticket->hora)); ?></p>
                    <p><strong>Reservas restantes:</strong> <?php echo $ticket->reservas; ?></p>
                </div>
                
                <form action="<?php echo base_url('tickets/process_reserva/') . $ticket->idTicket; ?>" method="POST" id="purchaseForm">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad de entradas reservadas:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" 
                               max="<?php echo $ticket->reservas; ?>" value="1" required>
                    </div>
                    
                    <div class="show-info mb-4">
                        <p><strong>Total a pagar:</strong> 
                            <span id="totalPrice">$<?php echo number_format($ticket->price, 2); ?></span>
                        </p>
                    </div>
                    
                    <div class="show-actions">
                        <a href="<?php echo base_url('tickets/show/') . $ticket->idTicket; ?>" class="btn btn-dark">Volver</a>
                        <button type="button" class="btn btn-custom" onclick="confirmPurchase()">Confirmar Reserva</button>
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
// Actualiza el precio total en función de la cantidad seleccionada
document.getElementById('cantidad').addEventListener('change', function(e) {
    const cantidad = parseInt(e.target.value);
    const precio = <?php echo $ticket->price; ?>;
    const total = cantidad * precio;
    document.getElementById('totalPrice').textContent = '$' + total.toFixed(2);

    // Si la cantidad es igual a la cantidad disponible, deshabilitamos el botón de confirmación
    if (cantidad >= <?php echo $ticket->reservas; ?>) {
        document.getElementById('confirmButton').disabled = true;
        document.getElementById('confirmButton').textContent = 'Agotado';
    } else {
        document.getElementById('confirmButton').disabled = false;
        document.getElementById('confirmButton').textContent = 'Confirmar Compra';
    }
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