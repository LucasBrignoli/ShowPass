<head>
<div class="show-container">
    <div class="show-header">
        <h1>Show</h1>
    </div>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/show.css'); ?>">
</head>
<body>
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
                    <?php endif; ?>
                    <?php if ($ticket->reservas > 0 && $ticket->state == 1): ?>   
                            <a href="<?php echo base_url('tickets/reserva/') . $ticket->idTicket; ?>" class="btn btn-custom">Reservar Entradas</a>
                        <?php endif; ?> 
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>