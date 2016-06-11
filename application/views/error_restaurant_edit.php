<html>
<head>
<title>Error Restaurant </title>
</head>
<body>
  <div class="container">
  <div class="alert alert-danger" role="alert">
  <?php echo validation_errors(); ?>
<h3>Erro <span class="glyphicon glyphicon-remove" aria-hidden="true"> </span></h3>
  </div>
<a href="<?php base_url().'Home'?>" class= "btn btn-primary btn-block" >Voltar ao inicio </a>
</div>
</body>
</html>
