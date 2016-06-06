<!--Popup -->
<div>
  <div class = "container">

<p style="font-size: 45px"> Lista de Users </p>
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
