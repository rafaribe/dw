<!-- Includes -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.rawgit.com/Nagashitw/dw/master/angular/css/bootstrap.min.css">
<link rel="stylesheet" href="https://raw.githubusercontent.com/Nagashitw/dw/master/angular/css/style.css">

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/Nagashitw/dw/master/angular/scripts/login.js"></script>
<style>body{padding-top: 70px}</style>

<!--End of Includes -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bom Garfo</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="Home">Home</a></li>
      <li><a href="Restaurantes">Restaurantes</a></li>
      <li><a href="<?php base_url().Users/view_all_users?>">Users</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">REST API <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Users">View All Users in JSON</a></li>
          <li><a href="Users/user/format/xml">View All Users in XML</a></li>
         <li><a href="Users/user/1">View User 1 </a></li>
       </ul>
      </li>
      <li><a href="Receitas">Receitas</a></li>
      <li><a href="Home/logout">Logout</a></li>
    </ul>
  </div>
</nav>
