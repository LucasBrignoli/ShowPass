<style>
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

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
    body {  
        background-image: url('<?php echo base_url("assets/uploads/shows/fondo.png"); ?>') !important;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        min-height: 100vh;
    }
    /* Estilos para formularios */
    .form-container {
        background-color: rgba(33, 37, 41, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        padding: 2rem;
        margin: 0 auto;
        max-width: 400px;
    }

    /* Estilos para cards */
    .custom-card {
        background-color: rgba(33, 37, 41, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        overflow: hidden;
    }

    /* Estilos para inputs */
    .form-control {
        background-color: rgba(52, 58, 64, 0.9) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
    }

    .form-control:focus {
        background-color: rgba(52, 58, 64, 0.95) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1) !important;
    }

    /* Estilos para botones */
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
</style>

<div class="show-container">
    <div class="show-header">
        <h1>Show</h1>
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
                <p><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($ticket->date)); ?></p>
                <p><strong>Hora:</strong> <?php echo date('H:i', strtotime($ticket->hora)); ?></p>
                <p><strong>Estado:</strong> 
                    <?php 
                    if ($ticket->state == 0) {
                        echo "Disponible";
                    } elseif ($ticket->state == 1 && $ticket->amount_available > 0) {
                        echo "Próximamente";
                    } else {
                        echo "Agotado";
                    }
                    ?>
                </p>
            </div>
            
            <div class="show-actions">
                <a href="<?php echo base_url('tickets'); ?>" class="btn btn-dark">Volver</a>
                <?php if($this->session->userdata('role') == 'admin'): ?>
                    <a href="<?php echo base_url('tickets/edit/') . $ticket->idTicket; ?>" class="btn btn-dark">Editar</a>
                    <form action="<?php echo base_url('tickets/delete/') . $ticket->idTicket; ?>" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                <?php else: ?>
                    <?php if ($ticket->amount_available > 0 && $ticket->state == 0): ?>
                        <a href="<?php echo base_url('tickets/compra/') . $ticket->idTicket; ?>" class="btn btn-custom">Comprar Entradas</a>
                        <a href="<?php echo base_url('tickets/reserva/') . $ticket->idTicket; ?>" class="btn btn-custom">Reservar Entradas</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
