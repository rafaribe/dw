<!-- Includes -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<style>body{padding-top: 70px}</style>
<!--End of Includes -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bom Garfo</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="http://localhost/dw/Home.php">Home</a></li>
      <li><a href="http://localhost/dw/Restaurant">Restaurants</a></li>
      <li><a href="http://localhost/dw/Users">Users</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">REST API <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="http://localhost/dw/rest">View All Users in JSON</a></li>
          <li><a href="http://localhost/dw/rest/all_users/format/xml">View All Users in XML</a></li>
         <li><a href="http://localhost/dw/rest/user/1">View User 1 </a></li>
       </ul>
      </li>
      <li><a href="http://localhost/dw/recipes">Recipes</a></li>
      <li><a href="http://localhost/dw/Login">Login</a></li>
    </ul>
  </div>
</nav>
