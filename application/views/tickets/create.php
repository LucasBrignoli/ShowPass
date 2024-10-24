<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h1 class="text-white my-4 text-center"><?php echo $title;?></h1>

      <?php $minDate = date('Y-m-d', strtotime('+1 day')); // Se obtiene la fecha de mañana ?>
      
      <form action="<?php echo base_url('tickets/store'); ?>" method="POST" class="text-light bg-dark rounded-4 border border-light p-3 mx-auto" method="post" action="" style="max-width: 350px;">
        
        <!-- Crear de nombre -->
        <div class="mb-3">
          <label for="name" class="form-label">Nombre:</label>
          <input type="text" class="form-control bg-dark text-light border-secondary" id="name" name="name" placeholder="Ingrese el nombre" required>
        </div>

        <!-- Crear precio -->
        <div class="mb-3">
          <label for="price" class="form-label">Precio:</label>
          <input type="number" step="0.01" class="form-control bg-dark text-light border-secondary" id="price" name="price" placeholder="Ingrese el precio" required min="1">
        </div>

        <!-- Campo oculto para indicar que el show está disponible -->
        <input type="hidden" name="state" value="1">

        <!-- Crear cantidad con condicion para que sea mayor a 0 -->
        <div class="mb-3">
          <label for="quantity" class="form-label">Cantidad de tickets:</label>
          <input type="number" class="form-control bg-dark text-light border-secondary" id="quantity" name="amount_available" placeholder="Ingrese la cantidad" required min="1">
        </div>

        <!-- Crear fecha con condicion para que sea mayor a la fecha actual -->
        <div class="mb-3">
          <label for="date" class="form-label">Fecha:</label>
          <input type="date" class="form-control bg-dark text-light border-secondary" id="date" name="date" required min="<?php echo $minDate; ?>">
        </div>

        <!-- Link -->
        <div class="mb-3">
          <label for="name" class="form-label">Link:</label>
          <input type="text" class="form-control bg-dark text-light border-secondary" id="name" name="url" placeholder="Ingrese el url" required>
        </div>

        <!-- Boton de envío -->
        <div class="text-center mt-4">
         <button type="submit" class="btn btn-primary">Crear show</button>
        </div>
      </form>
    </div>
  </div>
</div>
