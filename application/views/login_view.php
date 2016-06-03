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

<?php include "sample_navbar_view.php" ?>
<div class="container">
<h2 class="text-center">Login</h2>
<div class="row">
<div class="col-md-4 col-md-offset-4">
  <form name="Login" method="post" action="http://localhost/dw/Login/logging_in">

    <input class="form-control" type="text" class="user" name="username" placeholder="username">
    <input class="form-control"type="password" class="pass" name="password" placeholder="password">
    <button class="btn btn-danger"type="submit">Login</button>
  </form>
</div>
</div>


</div>
