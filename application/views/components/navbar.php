<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url('tickets');?>">Shows</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo base_url('tickets');?>">Lista de show</a></li>
              <?php if($this->session->userdata('role') == 'admin'): ?>
              <li><a class="dropdown-item" href="<?php echo base_url('tickets/create');?>">Crear show</a></li>
              <?php endif; ?>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuario
            </a>
            <ul class="dropdown-menu">
              <?php if($this->session->userdata('logged_in')): ?>
              <li><a class="dropdown-item" href="<?php echo base_url('auth/logout');?>">Cerrar sesion</a></li>
              <?php else: ?>
                <li><a class="dropdown-item" href="<?php echo base_url('auth/register_form');?>">Registrarse</a></li>
              <li><a class="dropdown-item" href="<?php echo base_url('auth/login_form');?>">Iniciar sesion</a></li>
              <?php endif; ?>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </nav>