<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h1 class="text-white my-4 text-center"><?php echo $title;?></h1>

      <?php $minDate = date('Y-m-d', strtotime('+1 day')); // Se obtiene la fecha de mañana ?>
      
      <form action="<?php echo base_url('tickets/update/') . $ticket->idTicket; ?>" method="POST" class="text-light bg-dark rounded-4 border border-light p-3 mx-auto" style="max-width: 350px;">
        
        <!-- Nombre -->
        <div class="mb-3">
          <label for="name" class="form-label">Nombre:</label>
          <input type="text" class="form-control bg-dark text-light border-secondary" id="name" name="name" value="<?php echo $ticket->name; ?>" placeholder="Ingrese el nombre" required>
        </div>

        <!-- Precio -->
        <div class="mb-3">
          <label for="price" class="form-label">Precio:</label>
          <input type="number" step="0.01" class="form-control bg-dark text-light border-secondary" id="price" name="price" value="<?php echo $ticket->price; ?>" placeholder="Ingrese el precio" required min="1">
        </div>

        <!-- Disponibilidad (estado) -->
        <div class="mb-3">
          <label for="state" class="form-label">Disponibilidad:</label>
          <input type="number" class="form-control bg-dark text-light border-secondary" id="state" name="state" value="<?php echo $ticket->state; ?>" placeholder="Ingrese la disponibilidad" required min="0" max="1">
        </div>

        <!-- Cantidad de tickets -->
        <div class="mb-3">
          <label for="amount_available" class="form-label">Cantidad de tickets:</label>
          <input type="number" class="form-control bg-dark text-light border-secondary" id="amount_available" name="amount_available" value="<?php echo $ticket->amount_available; ?>" placeholder="Ingrese la cantidad" required min="1">
        </div>

        <!-- Fecha -->
        <div class="mb-3">
          <label for="date" class="form-label">Fecha:</label>
          <input type="date" class="form-control bg-dark text-light border-secondary" id="date" name="date" value="<?php echo $ticket->date; ?>" required min="<?php echo $minDate; ?>">
        </div>

        <!-- Link -->
        <div class="mb-3">
          <label for="name" class="form-label">Link:</label>
          <input type="text" class="form-control bg-dark text-light border-secondary" id="name" name="url" value="<?php echo $ticket->url; ?>" placeholder="Ingrese el url" required>
        </div>

        <!-- Botón de envío -->
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary">Actualizar show</button>
        </div>
      </form>
    </div>
  </div>
</
