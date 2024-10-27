<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $errors = $this->session->flashdata('errors'); ?>
<?php $success = $this->session->flashdata('success'); ?>
<?php if(isset($success)): ?>
    <div class="alert alert-success" role= "alert">
    <?php echo $success; ?>
    </div>
<?php endif; ?>
<?php if(isset($errors)): ?>
  <?php foreach($errors as $error):?>
    <div class="alert alert-danger" role= "alert">
    <?php echo $error; ?>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
<h1 class="text-white text-center my-5"><?php echo $title; ?></h1>
<div class="d-flex justify-content-center">
  <form action="<?php echo base_url('auth/register'); ?>" method="POST" class="text-light bg-dark rounded-4 border border-light p-4" style="width: 100%; max-width: 400px;">
    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" class="form-control bg-white text-dark border" id="email" name="email" placeholder="Ingrese su email">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña:</label>
      <input type="password" class="form-control bg-white text-dark border" id="password" name="password" placeholder="Ingrese su contraseña">
    </div>
    <div class="mb-3">
      <label for="confirm-password" class="form-label">Repetir contraseña:</label>
      <input type="password" class="form-control bg-white text-dark border" id="confirm-password" name="confirm-password" placeholder="Repita su contraseña">
    </div>
    <div class="d-flex justify-content-center p-2">
      <button type="submit" class="btn btn-primary">Registrarse</button>
    </div>
  </form>
</div>