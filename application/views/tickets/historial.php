<style>
    .table td, .table th {
        text-align: center;
        vertical-align: middle;
    }
    .action-buttons {
        display: flex;
        justify-content: center;
    }
    .action-buttons a {
        display: inline-block;
    }
    body {  
        background-image: url('<?php echo base_url("assets/uploads/shows/fondo.png"); ?>') !important;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        min-height: 100vh;
    }
</style>

<h1 class="text-center text-white my-5">Lista de Ventas</h1>
<div class="table-responsive px-5">
    <table class="table table-bordered table-dark table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center">Show</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Hora</th>
                <th scope="col" class="text-center">Total</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ventas)): ?>
                <?php foreach($ventas as $venta): ?>
                    <tr>
                        <td class="align-middle"><?php echo $venta->show; ?></td>
                        <td class="align-middle"><?php echo $venta->email; ?></td>
                        <td class="align-middle"><?php echo $venta->amount; ?></td>
                        <td class="align-middle"><?php echo $venta->fecha; ?></td>
                        <td class="align-middle"><?php echo $venta->hora; ?></td>
                        <td class="align-middle"><?php echo '$' . $venta->total; ?></td>
                        <td class="align-middle">
                            <div class="action-buttons">
                            <a href="<?php echo base_url('tickets'); ?>" class="btn btn-dark">Volver</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center fs-5">No hay ventas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
