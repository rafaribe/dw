<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
          <h2>View your Menu</h2><br><hr>
          <label for="SelectMenu">Select the Menu</label><br>
          <select id="SelectMenu" name="SelectMenu">
            <?php foreach($list as $lista): ?>
              <option value="<?php echo $lista->MENU_ID; ?>"><?php echo $lista->MENU_NAME; ?></option>
            <?php endforeach;  ?>
          </select>

          <input class="form-control" type="text" class="user" id="MenuName" name="MenuName" placeholder="Menu Name"><br>

</div>
<div>
<script src="<?php echo base_url().'assets/scripts/restaurant.js.'?>"> </script>
</div>
