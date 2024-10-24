<style>
    .table td, .table th {
        text-align: center;
        vertical-align: middle;
    }
</style>

<h1 class="text-center text-white my-5">Lista de shows</h1>
<div class="table-responsive px-5">
    <table class="table table-bordered table-dark table-striped">
        <thead>
          <tr>
            <th scope="col" class="text-center">Show</th>
            <th scope="col" class="text-center">Precio</th>
            <th scope="col" class="text-center">Fecha del show</th>
            <th scope="col" class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
            <?php if (!empty($tickets)): ?>
                <?php foreach($tickets as $ticket): ?>
                    <tr>
                        <td class="align-middle">
                            <div class="d-flex flex-column align-items-center">
                                <span class="mb-2"><?php echo $ticket->name; ?></span>
                                <?php if (!empty($ticket->url)): ?>
                                    <img src="<?php echo $ticket->url; ?>" 
                                        alt="Imagen del show" 
                                        class="img-fluid" 
                                        style="max-width: 150px; max-height: 150px;">
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="align-middle"><?php echo '$' . $ticket->price; ?></td>
                        <td class="align-middle"><?php echo $ticket->date; ?></td>
                        <td class="align-middle">
                            <a href="<?php echo base_url('tickets/show/') . $ticket->idTicket; ?>">Ver</a> 
                            |
                            <a href="<?php echo base_url('tickets/edit/') . $ticket->idTicket; ?>">Editar</a> 
                            | Borrar
                        </td> 
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center fs-5">No hay tickets a la venta.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>