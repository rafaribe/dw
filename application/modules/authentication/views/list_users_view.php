<!--<div class="header"><?php include('application/modules/common/sample_navbar_view.php');?></div>
-->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<div class = "jumbotron">
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
      <td><?php echo $login->USER_PHONE ?></td>
    </tr>
  <?php endforeach ?>
</table>
  </div>
</div>
