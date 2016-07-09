<!--Register Page -->
 <meta http-equiv="content-type" content="application/xml; charset=UTF-8">
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-1">
  <script></script>
    <?php echo form_open_multipart('dish/dish_add_xml');?>
    <form name="dish_add" method="post" action="<?php echo site_url().'Dish/dish_add'; ?>">
          <h2>Register your Dish</h2><br><hr>
          <label for="DishName">Dish Name</label>
          <input class="form-control" type="text" class="user" id="DishName" name="DishName" placeholder="Dish Name"><br>
          <label for="DishType">Dish Type</label>
          <input class="form-control"type="text" class="pass" id="DishType"name="DishType" placeholder="Dish Type"><br>
          <label for="DishImage">Picture</label>
          <input class="form-control"type="file" class="image" id="DishImage"name="DishImage" placeholder="Upload a Picture"><br>
<div class="container">
      <?php echo validation_errors(); ?>
</div>
          <button class="btn btn-danger"type="submit">Registar</button>
        </form>
</div>
<div class="col-md-4 col-md-offset-1">
    <form name="dish_add2" method="post" action="<?php echo site_url().'Dish/dish_add_xml_direct'; ?>" enctype="text/multipart/form-data">
          <h2>Insert your XML Data</h2><br><hr>
            <textarea type="text" class="form-control input-lg" id="xmldata" rows="5"name="xmldata"  placeholder="Insert your XML Here"></textarea><br>
            <button class="btn btn-danger"type="submit">Registar XML</button>

            php
        </form>
</div>
  <script src="http://localhost/dw/assets/scripts/dishes.js"></script>
</div>
