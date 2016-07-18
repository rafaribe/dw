<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <?php echo form_open('Dish/dish_edit_data');?>
    <form name="dish_edit" method="post" action="<?php echo site_url().'Dish/dish_edit_data'; ?>">
          <h2>Edit your Dish</h2><br><hr>
          <label for="SelectDish">Select your Dish</label><br>
          <select id="SelectDish" name="SelectDish">
            <?php foreach ($list as $lista): ?>
              <option value="<?php echo $lista->DISH_ID; ?>"><?php echo $lista->DISH_NAME; ?></option>
            <?php endforeach;  ?>
          </select>
          <label for="DishName">Dish Name</label>
          <input class="form-control" type="text" class="user" id="DishName" name="DishName" placeholder="Dish Name"><br>
          <div class="container">
      <?php echo validation_errors(); ?>
</div>
          <button class="btn btn-danger"type="submit">Update</button>
        </form>
</div>
<div>
  <script src="http://localhost/dw/assets/scripts/restaurant.js"></script>
</div>
