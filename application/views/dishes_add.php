<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
  <!--  <?php echo form_open('Register'); ?> -->
<!--<form name="register" method="post" action="<?php echo site_url('Register'); ?>"> -->
    <h2>Inserir Prato</h2>
    <input class="form-control" type="text" class="name" name="name" placeholder="Nome">
    <input class="form-control"type="text" class="type" name="type" placeholder="Tipo">
    <input class="form-control"type="number" class="numero" name="price" placeholder="Preço">
    <input class="form-control"type="text" class="menu" name="menu" placeholder="Menu">
      <div class="container">
      <?php echo validation_errors(); ?>
    </div>

    <button class="btn btn-danger"type="submit">Inserir</button>
  </form>
</div>
</div>
