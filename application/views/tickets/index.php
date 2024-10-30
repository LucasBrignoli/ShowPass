<head>
<h1 class="text-center text-white my-5">ShowPass</h1>
<link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
</head>
<body>
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
</body>