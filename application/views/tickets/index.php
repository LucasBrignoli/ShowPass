<style>
    .tickets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .ticket-card {
        background: rgba(33, 37, 41, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.5rem;
        overflow: hidden;
        transition: transform 0.2s;
    }

    .ticket-card:hover {
        transform: translateY(-5px);
    }

    .ticket-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background-color: #343a40;
    }

    .ticket-content {
        padding: 1rem;
    }

    .ticket-title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: white;
        text-align: center;
    }

    .ticket-info {
        color: #dee2e6;
        margin-bottom: 0.5rem;
        display: flex;
        justify-content: space-between;
    }

    .ticket-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        padding: 1rem;
        background: rgba(0, 0, 0, 0.2);
    }

    /* Estilos adicionales */
    .ticket-image-placeholder {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #343a40;
        color: #868e96;
        height: 200px;
        font-size: 1.2rem;
    }

    /* Botones personalizados */
    .btn-dark {
        background-color: #343a40;
        color: #fff;
        border: none;
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

    .btn-light {
        background-color: #f8f9fa;
        color: #343a40;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }
</style>

<h1 class="text-center text-white my-5">Lista de shows</h1>

<div class="tickets-grid">
    <?php if (!empty($tickets)): ?>
        <?php foreach($tickets as $ticket): ?>
            <div class="ticket-card">
                <?php if (!empty($ticket->url)): ?>
                    <img src="<?php echo base_url($ticket->url); ?>" 
                         alt="Imagen del show <?php echo $ticket->name; ?>" 
                         class="ticket-image">
                <?php else: ?>
                    <div class="ticket-image-placeholder">
                        <span>Sin imagen</span>
                    </div>
                <?php endif; ?>

                <div class="ticket-content">
                    <h3 class="ticket-title"><?php echo $ticket->name; ?></h3>

                <div class="ticket-info">
                     <span>Fecha: <?php echo $ticket->date; ?></span>
                      <span>Hora: <?php echo date('H:i', strtotime($ticket->hora)); ?></span>
                </div>

                </div>

                <div class="ticket-actions">
                    <a href="<?php echo base_url('tickets/show/') . $ticket->idTicket; ?>" 
                       class="btn btn-dark btn-sm">Detalle</a>
                <?php if($this->session->userdata('role') == 'admin'): ?>
                    <a href="<?php echo base_url('tickets/edit/') . $ticket->idTicket; ?>" 
                       class="btn btn-dark btn-sm">Editar</a>
                    <form action="<?php echo base_url('tickets/delete/') . $ticket->idTicket; ?>" 
                          method="POST" 
                          style="display:inline;">
                        <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                    </form>
                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center text-white fs-5">
            No hay tickets a la venta.
        </div>
    <?php endif; ?>
</div>
