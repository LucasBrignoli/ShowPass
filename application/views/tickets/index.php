<h1 class="text-center text-white my-5">Lista de shows</h1>
<div class="table-responsive px-5">
    <table class="table table-bordered table-dark table-striped">
        <thead>
          <tr>
            <th scope="col">Show</th>
            <th scope="col">Precio</th>
            <th scope="col">Fecha del show</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            <?php if (!empty($tickets)): ?>
                <?php foreach($tickets as $ticket): ?>
          <tr>
            <td> <?php echo $ticket->name; ?></td>
            <td> <?php echo '$' . $ticket->price; ?></td>
            <td> <?php echo $ticket->date; ?></td>
            <td> <a href="<?php echo base_url('tickets/show/') . $ticket->idTicket; ?>">Ver</a> 
                | Editar | Borrar </td> 
          </tr>
          <?php endforeach; ?>
          <?php else: ?>
            <tr>
            <td colspan="4" class="text-center fs-5"> No hay tickets a la venta.</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>