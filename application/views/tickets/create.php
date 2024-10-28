<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h1 class="text-white my-4 text-center"><?php echo $title;?></h1>

      <?php $minDate = date('Y-m-d', strtotime('+1 day')); ?>
      
      <!-- Removido el action duplicado -->
      <form action="<?php echo base_url('tickets/store'); ?>" method="POST" class="text-light bg-dark rounded-4 border border-light p-3 mx-auto" enctype="multipart/form-data" style="max-width: 350px;">
        
        <!-- Mostrar mensajes de error si existen -->
        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
        
        <div class="mb-3">
          <label for="name" class="form-label">Nombre:</label>
          <input type="text" class="form-control bg-dark text-light border-secondary" id="name" name="name" placeholder="Ingrese el nombre" required>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Precio:</label>
          <input type="number" step="0.01" class="form-control bg-dark text-light border-secondary" id="price" name="price" placeholder="Ingrese el precio" required min="1">
        </div>

        <input type="hidden" name="state" value="0">

        <div class="mb-3">
          <label for="quantity" class="form-label">Cantidad de tickets:</label>
          <input type="number" class="form-control bg-dark text-light border-secondary" id="quantity" name="amount_available" placeholder="Ingrese la cantidad" required min="1">
        </div>

        <div class="mb-3">
          <label for="date" class="form-label">Fecha:</label>
          <input type="date" class="form-control bg-dark text-light border-secondary" id="date" name="date" required min="<?php echo $minDate; ?>">
        </div>
        
        <div class="mb-3">
          <label for="url" class="form-label">Imagen</label>
          <input type="file" id="url" name="url" class="form-control bg-dark text-light border-secondary">
        </div>

        <div class="mb-3">
            <!-- Corregido type="submit" -->
            <button type="submit" class="btn btn-success w-100">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>