<?php include "sample_navbar_view.php" ?>
<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <?php echo form_open('Register'); ?>
  <form name="register" method="post" action="<?php echo site_url('Register'); ?>">
    <h2>Registar Utilizador</h2>
    <input class="form-control" type="text" class="user" name="username" placeholder="username">
    <input class="form-control"type="password" class="pass" name="password" placeholder="password">
    <input class="form-control"type="number" class="numero" name="phone" placeholder="Telefone">
    <input class="form-control"type="email" class="email" name="email" placeholder="Email">
    <div class="container">
      <?php echo validation_errors(); ?>
    </div>

    <button class="btn btn-danger"type="submit">Registar</button>
  </form>
</div>
</div>


</div>
