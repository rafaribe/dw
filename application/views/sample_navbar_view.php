<!-- Includes -->
<!-- jQuery library -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<style>body{padding-top: 70px}</style>
<!--End of Includes -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="#">Bom Garfo</a>
   </div>
   <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
        <li><a href=" <?php echo base_url().'Home' ?>">Home</a></li>
      <li><a href=" <?php echo base_url().'Restaurant'?>">Restaurants </a></li>
      <li><a href=" <?php echo base_url(). 'Menus' ?>">Menus</a></li>
      <li><a href=" <?php echo base_url(). 'Dishes'?>">Dishes</a></li>


      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">REST API <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href=" <?php echo base_url(). 'rest'?>">View All Users in JSON</a></li>
          <li><a href=" <?php echo base_url(). 'rest?format=xml'?>">View All Users in XML</a></li>
          <li><a href=" <?php echo base_url(). 'rest/user/1'?>">View User 1 </a></li>
       </ul>
      </li>
</ul>
     <ul class="nav navbar-nav navbar-right">
      <?php
          $islogged = sizeof($this->session->userdata('logged_in'));
          if ($islogged == 0)
          { ?>

              <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-user"></span> Guest
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href=" <?php echo base_url(  ). 'Login'?>">Login <span class="glyphicon glyphicon-log-in"></span></a></li>
              <li><a href=" <?php echo base_url(). 'Register'?>">Register  <span class="glyphicon glyphicon-list-alt"></span></a></li>
               </ul>
              </li>
<?php } else { ?>
              <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>
               <?php echo $this->session->userdata['logged_in']['username'] ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href=" <?php echo base_url(). 'Home/logout'?>">Logout    <span class="glyphicon glyphicon-log-out"></span></a></li>
              </ul>
              </li>
    <?php  } ?>
    </ul>
  </div>
</nav>
