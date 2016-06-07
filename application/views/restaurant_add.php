<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <?php echo form_open_multipart('restaurant/restaurant_add');?>
  <form name="restaurant_add" method="post" action="<?php echo site_url().'Restaurant/restaurant_add'; ?>">
    <h2>Register your Restaurant</h2>
    <input class="form-control" type="text" class="user" name="RestaurantName" placeholder="Restaurant Name">
    <input class="form-control"type="text" class="pass" name="RestaurantAddress" placeholder="Restaurant Address">
    <input class="form-control"type="number" class="numero" name="RestaurantReservations" placeholder="Restaurant Rerservations">
      <input class="form-control"type="number" class="numero" name="RestaurantWifi" placeholder="Wi-Fi">
      <input class="form-control"type="number" class="numero" name="RestaurantDelivery" placeholder="Home Deliveries">
      <input class="form-control"type="number" class="numero" name="RestaurantMultibanco" placeholder="Have Multibanco?">
        <input class="form-control"type="number" class="numero" name="RestaurantOutdoorSeating" placeholder="Esplanada">
      <input class="form-control"type="file" class="image" name="RestaurantImage" placeholder="Upload a Picture">
    <div class="container">
      <?php echo validation_errors(); ?>
    </div>
    <button class="btn btn-danger"type="submit">Registar</button>
  </form>
</div>
</div>
