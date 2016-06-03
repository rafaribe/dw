<!--Login Page -->
<div class="container">
  <?php echo validation_errors(); ?>
  <?php echo form_open('form'); ?>
<div class="row">
<div class="col-md-4 col-md-offset-4">
  <form name="register" method="post" action="<?php echo site_url('Register'); ?>">
    <h2>Registar Utilizador</h2>
    <input class="form-control" type="text" class="user" name="username" placeholder="username">
    <input class="form-control"type="password" class="pass" name="password" placeholder="password">
    <input class="form-control"type="email" class="email" name="email" placeholder="Email">
    <input class="form-control"type="number" class="numero" name="phone" placeholder="Telefone">
    <button class="btn btn-danger"type="submit">Registar</button>
  </form>
</div>
</div>


</div>
