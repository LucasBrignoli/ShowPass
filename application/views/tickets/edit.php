<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/edit.css'); ?>">
</head>
<body>
<!-- Fondo y overlay -->
<div class="bg-container"></div>
<div class="overlay"></div>

<!-- Contenido principal -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h1 class="text-white my-4 text-center"><?php echo $title; ?></h1>

      <?php $minDate = date('Y-m-d', strtotime('+1 day')); ?>

      <form action="<?php echo base_url('tickets/update/') . $ticket->idTicket; ?>" 
            method="POST" 
            enctype="multipart/form-data" 
            class="text-light bg-dark rounded-4 border border-light p-3 mx-auto" 
            style="max-width: 350px;">

        <!-- Nombre -->
        <div class="mb-3">
          <label for="name" class="form-label">Nombre:</label>
          <input type="text" class="form-control bg-dark text-light border-secondary" 
                 id="name" name="name" value="<?php echo $ticket->name; ?>" 
                 placeholder="Ingrese el nombre" required>
        </div>

        <!-- Precio -->
        <div class="mb-3">
          <label for="price" class="form-label">Precio:</label>
          <input type="number" step="0.01" class="form-control bg-dark text-light border-secondary" 
                 id="price" name="price" value="<?php echo $ticket->price; ?>" 
                 placeholder="Ingrese el precio" required min="1">
        </div>

        <!-- Disponibilidad (estado) -->
        <div class="mb-3">
          <label for="state" class="form-label">Disponibilidad:</label>
          <select class="form-control bg-dark text-light border-secondary" 
                  id="state" name="state" required>
            <option value="0" <?php echo ($ticket->state == 0) ? 'selected' : ''; ?>>Disponible</option>
            <option value="1" <?php echo ($ticket->state == 1) ? 'selected' : ''; ?>>Agotado</option>
          </select>
        </div>

        <!-- Cantidad de tickets -->
        <div class="mb-3">
          <label for="amount_available" class="form-label">Cantidad de tickets:</label>
          <input type="number" class="form-control bg-dark text-light border-secondary" 
                 id="amount_available" name="amount_available" 
                 value="<?php echo $ticket->amount_available; ?>" 
                 placeholder="Ingrese la cantidad" required min="0">
        </div>

        <!-- Cantidad de tickets -->
        <div class="mb-3">
          <label for="reservas" class="form-label">Cantidad de tickets de reserva:</label>
          <input type="number" class="form-control bg-dark text-light border-secondary" 
                 id="reservas" name="reservas" 
                 value="<?php echo $ticket->reservas; ?>" 
                 placeholder="Ingrese la cantidad" required min="0">
        </div>



        <!-- Fecha -->
        <div class="mb-3">
          <label for="date" class="form-label">Fecha:</label>
          <input type="date" class="form-control bg-dark text-light border-secondary" 
                 id="date" name="date" value="<?php echo $ticket->date; ?>" 
                 required min="<?php echo $minDate; ?>">
        </div>

        <!-- Hora -->
        <div class="mb-3">
          <label for="hora" class="form-label">Hora:</label>
          <input type="time" class="form-control bg-dark text-light border-secondary" 
                 id="hora" name="hora" value="<?php echo date('H:i', strtotime($ticket->hora)); ?>" 
                 required>
        </div>

        <!-- Imagen -->
        <div class="mb-3">
          <label for="url" class="form-label">Imagen:</label>
          <input type="file" class="form-control bg-dark text-light border-secondary" 
                 id="url" name="url" accept="image/*">
        </div>

        <!-- Botón de envío -->
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary">Actualizar show</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script para actualizar automáticamente el estado a "Agotado" si la cantidad es 0 -->
<script>
    document.getElementById('amount_available').addEventListener('input', function () {
        const amount = parseInt(this.value);
        const stateSelect = document.getElementById('state');
        
        if (amount === 0) {
            stateSelect.value = '1'; // Cambia el estado a "Agotado"
        } else {
            stateSelect.value = '0'; // Cambia el estado a "Disponible" si la cantidad es mayor a 0
        }
    });
</script>

</body>
</html>