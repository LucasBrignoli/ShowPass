<h1 class="text-center text-white my-5">Show</h1>
<div class="table-responsive px-5">
    <table class="table table-bordered table-dark table-striped">
        <thead>
          <tr>
            <th scope="col">Estado</th>
            <th scope="col">Show</th>
            <th scope="col">Precio</th>
            <th scope="col">Fecha del show</th>
            <th scope="col">Entradas restantes</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php if (!empty($ticket->state)): ?>
                        <?php echo "Agotado"; ?>            <!-- 0 -->
                    <?php else: ?>
                        <?php echo "Disponible"; ?>         <!-- 1 -->
                    <?php endif; ?>
                </td>
                <td><?php echo $ticket->name; ?></td>
                <td><?php echo '$'. $ticket->price; ?></td>
                <td><?php echo $ticket->date; ?></td>
                <td><?php echo $ticket->amount_available; ?></td>
                <td> 
                <a href="<?php echo base_url('tickets'); ?>">Volver</a> 
                | Editar | Borrar
              </td>
            </tr>
        </tbody>
      </table>
    </div>