<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <?php echo form_open('Restaurant/restaurant_delete_data');?>
    <form name="restaurant_edit" method="post" action="<?php echo site_url().'Restaurant/restaurant_edit_data'; ?>">
          <h2>Delete Restaurant</h2><br><hr>
          <label for="SelectRestaurant">Select your Restaurant</label><br>
          <select id="SelectResaurant" name="SelectResaurant">
            <?php foreach($list as $lista): ?>
              <option value="<?php echo $lista->RESTAURANT_ID; ?>"><?php echo $lista->RESTAURANT_NAME; ?></option>
            <?php endforeach;  ?>
          </select>
<div class="container">
      <?php echo validation_errors(); ?>
</div>
        <button class="btn btn-danger"type="submit">Delete</button>
      </form>
</div>
<div>
  <script src="http://localhost/dw/assets/scripts/restaurant.js"></script>
</div>
