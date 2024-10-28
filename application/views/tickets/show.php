<style>
    .table td, .table th {
        text-align: center;
        vertical-align: middle;
    }
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .action-buttons a, .action-buttons button {
        display: inline-block;
    }

    /* Botones personalizados */
    .btn-dark {
        background-color: #343a40;
        color: #fff;
        border: none;
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

<h1 class="text-center text-white my-5">Show</h1>
<div class="table-responsive px-5">
    <table class="table table-bordered table-dark table-striped">
        <thead>
          <tr>
            <th scope="col" class="text-center">Show</th>
            <th scope="col" class="text-center">Precio</th>
            <th scope="col" class="text-center">Fecha del show</th>
            <th scope="col" class="text-center">Entradas restantes</th>
            <th scope="col" class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
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
                    <?php if (!empty($ticket->state)): ?>
                        <?php echo "Agotado"; ?>
                    <?php else: ?>
                        <?php echo $ticket->amount_available ?>
                    <?php endif; ?>
                </td>
                <td class="align-middle">
                    <div class="action-buttons">
                        <a href="<?php echo base_url('tickets'); ?>" class="btn btn-dark btn-sm">Volver</a>
                    <?php if($this->session->userdata('role') == 'admin'): ?>
                        <a href="<?php echo base_url('tickets/edit/') . $ticket->idTicket; ?>" class="btn btn-dark btn-sm">Editar</a>
                        <form action="<?php echo base_url('tickets/delete/') . $ticket->idTicket; ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                        </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
