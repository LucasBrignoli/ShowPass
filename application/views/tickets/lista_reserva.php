<h1 class="text-center text-white my-5">Lista de reservas</h1>
<div class="table-responsive px-5">
    <table class="table table-bordered table-dark table-striped">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/historial.css'); ?>">
        <thead>
            <tr>
                <th scope="col" class="text-center">Show</th>
                <th scope="col" class="text-center">Cliente/Email</th>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Hora</th>
                <th scope="col" class="text-center">Total</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($reservas)): ?>
                <?php foreach ($reservas as $reserva): ?>
                    <?php if ($this->session->userdata('role') == 'customer'): ?>
                        <?php if ($reserva->cliente == $this->session->userdata('email')): ?>
                            <tr>
                                <td class="align-middle"><?php echo $reserva->show; ?></td>
                                <td class="align-middle"><?php echo $reserva->cliente; ?></td>
                                <td class="align-middle"><?php echo $reserva->amount; ?></td>
                                <td class="align-middle"><?php echo $reserva->date; ?></td>
                                <td class="align-middle"><?php echo $reserva->time; ?></td>
                                <td class="align-middle"><?php echo '$' . $reserva->total; ?></td>
                                <td class="align-middle">
                                    <div class="action-buttons">
                                        <a href="<?php echo base_url('tickets'); ?>" class="btn btn-dark">Volver</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php elseif ($this->session->userdata('role') == 'admin'): ?>
                        <tr>
                            <td class="align-middle"><?php echo $reserva->show; ?></td>
                            <td class="align-middle"><?php echo $reserva->cliente; ?></td>
                            <td class="align-middle"><?php echo $reserva->amount; ?></td>
                            <td class="align-middle"><?php echo $reserva->date; ?></td>
                            <td class="align-middle"><?php echo $reserva->time; ?></td>
                            <td class="align-middle"><?php echo '$' . $reserva->total; ?></td>
                            <td class="align-middle">
                                <div class="action-buttons">
                                    <a href="<?php echo base_url('tickets'); ?>" class="btn btn-dark">Volver</a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center fs-5">No hay reservas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>