<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <?php echo form_open_multipart('dish/dish_add');?>
    <form name="dish_add" method="post" action="<?php echo site_url().'Dish/dish_add'; ?>">
          <h2>Register your Dish</h2><br><hr>
          <label for="DishName">Dish Name</label>
          <input class="form-control" type="text" class="user" id="DishName" name="DishName" placeholder="Dish Name"><br>
          <label for="DishType">Dish Type</label>
          <input class="form-control"type="text" class="pass" id="DishType"name="DishType" placeholder="Dish Type"><br>
          <label for="DishImage">Upload a picture of your restaurant</label>
          <input class="form-control"type="file" class="image" id="DishImage"name="DishImage" placeholder="Upload a Picture"><br>
<div class="container">
      <?php echo validation_errors(); ?>
</div>
          <button class="btn btn-danger"type="submit">Registar</button>
        </form>
</div>
</div>
