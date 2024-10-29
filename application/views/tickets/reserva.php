<?php
if (!$this->session->userdata('logged_in')) {
    redirect('auth/login');
}

// Verificar si hay suficientes entradas disponibles
if ($ticket->amount_available <= 0 || !empty($ticket->state)) {
    $this->session->set_flashdata('error', 'Lo sentimos, no hay entradas disponibles.');
    redirect('tickets/show/' . $ticket->idTicket);
}
?>

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
                <p><strong>Precio por entrada:</strong> $<?php echo number_format($ticket->price, 2); ?></p>
                <p><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($ticket->date)); ?></p>
                <p><strong>Entradas disponibles:</strong> <?php echo $ticket->amount_available; ?></p>
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
                    <button type="submit" class="btn btn-custom">Confirmar Compra</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('cantidad').addEventListener('change', function(e) {
    const cantidad = parseInt(e.target.value);
    const precio = <?php echo $ticket->price; ?>;
    const total = cantidad * precio;
    document.getElementById('totalPrice').textContent = '$' + total.toFixed(2);
});
</script>