<?php include('sample_navbar_view.php');?>
<!-- Includes -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://localhost/dw/angular/css/bootstrap.min.css">
<link rel="stylesheet" href="http://localhost/dw/angular/css/style.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/Nagashitw/dw/master/angular/scripts/login.js"></script>
<!--Popup -->
<div>
  <div class = "container"
    <h1>Lista de Users</h1>
<table class="table">
  <tr>
    <th>Username</th>
    <th>Password</th>
    <th></th>
  </tr>
  <?php foreach($list as $login): ?>
    <tr>
      <td><?php echo $login->USER_NAME ?></td>
      <td><?php echo $login->USER_PASSWORD ?></td>
    </tr>
  <?php endforeach ?>
</table>
  </div>
</div>
