<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <?php echo form_open('Restaurant/restaurant_edit');?>

    <form name="restaurant_edit" method="post" action="<?php echo site_url().'Restaurant/restaurant_edit'; ?>">
          <h2>Edit your Restaurant</h2><br><hr>
          <label for="SelectRestaurant">Select your Restaurant</label><br>
          <select id="SelectResaurant" name="SelectResaurant">
            <?php foreach($list as $lista): ?>
              <option value="<?php echo $lista->RESTAURANT_ID; ?>"><?php echo $lista->RESTAURANT_NAME; ?></option>
            <?php endforeach;  ?>
          </select>
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
          <label for="RestaurantMultibanco">Have Multibanco</label>
          <input class="form-control"type="number" class="numero" id="RestaurantMultibanco"name="RestaurantMultibanco" placeholder="Have Multibanco?"><br>
          <label for="RestaurantOutdoorSeating">Have Outdoor Siting</label>
          <input class="form-control"type="number" class="numero" id="RestaurantOutdoorSeating" name="RestaurantOutdoorSeating" placeholder="Have Outdoor Siting"><br>
<div class="container">
      <?php echo validation_errors(); ?>
</div>
          <button class="btn btn-danger"type="submit">Update</button>
        </form>
</div>
<div>
  <script src="http://localhost/dw/assets/scripts/restaurant.js"></script>
</div>
