<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <?php echo form_open_multipart('restaurant/restaurant_add');?>
    <form name="restaurant_add" method="post" action="<?php echo site_url().'Restaurant/restaurant_add'; ?>">
          <h2>Register your Restaurant</h2><br><hr>
          <label for="RestaurantName">Restaurant Name</label>
          <input class="form-control" type="text" class="user" id="RestaurantName" name="RestaurantName" placeholder="Restaurant Name"><br>
          <label for="RestaurantAddress">Address</label>
          <input class="form-control"type="text" class="pass" id="RestaurantAddress"name="RestaurantAddress" placeholder="Restaurant Address"><br>
          <label for="RestaurantReservations">Reservations</label>
          <input class="form-control"type="number" class="numero" id="RestaurantReservations"name="RestaurantReservations" placeholder="Restaurant Rerservations"><br>
          <label for="RestaurantWifi">Have Wifi</label>
          <input class="form-control"type="number" class="numero" id="RestaurantWifi"name="RestaurantWifi" placeholder="Wi-Fi"><br>
          <label for="RestaurantDelivery">Home Delivery</label>
          <input class="form-control"type="number" class="numero" id="RestaurantDelivery"name="RestaurantDelivery" placeholder="Home Deliveries"><br>
          <label for="RestaurantMultibanconame">Have Multibanco</label>
          <input class="form-control"type="number" class="numero" id="RestaurantMultibanconame"name="RestaurantMultibanco" placeholder="Have Multibanco?"><br>
          <label for="RestaurantOutdoorSeating">Have Outdoor Siting</label>
          <input class="form-control"type="number" class="numero" id="RestaurantOutdoorSeating" name="RestaurantOutdoorSeating" placeholder="Have Outdoor Siting"><br>
          <label for="RestaurantImage">Upload a picture of your restaurant</label>
          <input class="form-control"type="file" class="image" id="RestaurantImage"name="RestaurantImage" placeholder="Upload a Picture"><br>
<div class="container">
      <?php echo validation_errors(); ?>
</div>
          <button class="btn btn-danger"type="submit">Registar</button>
        </form>
</div>
</div>