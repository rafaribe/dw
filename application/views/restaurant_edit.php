<!--Register Page -->
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
    <?php echo form_open('Restaurant/restaurant_edit_data');?>
    <form name="restaurant_edit" method="post" action="<?php echo site_url().'Restaurant/restaurant_edit_data'; ?>">
          <h2>Edit your Restaurant</h2><hr>
          <label for="SelectRestaurant">Select your Restaurant</label><br>
          <select id="SelectResaurant" name="SelectResaurant">
            <?php foreach($list as $lista): ?>
              <option value="<?php echo $lista->RESTAURANT_ID; ?>"><?php echo $lista->RESTAURANT_NAME; ?></option>
            <?php endforeach;  ?>
          </select><br /><br />
          <label for="RestaurantName">Restaurant Name</label>
          <input class="form-control" type="text"  id="RestaurantName" name="RestaurantName" placeholder="Restaurant Name"><br>
          <label for="RestaurantAddress">Address</label>
          <input class="form-control"type="text" id="RestaurantAddress"name="RestaurantAddress" placeholder="Restaurant Address"><br>
          <label for="RestaurantReservations">Reservations</label>
          <input class="form-control"type="number"  id="RestaurantReservations"name="RestaurantReservations" min="0" max="1" placeholder="Restaurant Rerservations"><br>
          <label for="RestaurantOpenHours">Open Hours</label>
          <input class="form-control input-sm"type="text"  id="RestaurantOpenHours"  name="RestaurantOpenHours" maxlength="5">
          <input class="form-control input-sm"type="text"  id="RestaurantOpenHours2" name="RestaurantOpenHours2" maxlength="5">
          <input class="form-control input-sm"type="text"  id="RestaurantOpenHours3" name="RestaurantOpenHours3" maxlength="5">
          <input class="form-control input-sm"type="text"  id="RestaurantOpenHours4" name="RestaurantOpenHours4" maxlength="5">
          <input class="form-control input-sm"type="text"  id="RestaurantOpenHours5" name="RestaurantOpenHours5" maxlength="5">
          <input class="form-control input-sm"type="text"  id="RestaurantOpenHours6" name="RestaurantOpenHours6" maxlength="5">
          <label for="RestaurantWifi">Have Wifi</label>
          <input class="form-control"type="number"  id="RestaurantWifi"name="RestaurantWifi" min="0" max="1" placeholder="Wi-Fi"><br>
          <label for="RestaurantDelivery">Home Delivery</label>
          <input class="form-control"type="number" id="RestaurantDelivery"name="RestaurantDelivery"  min="0" max="1" placeholder="Home Deliveries"><br>
          <label for="RestaurantMultibanconame">Have Multibanco</label>
          <input class="form-control"type="number"  id="RestaurantMultibanco"name="RestaurantMultibanco"  min="0" max="1" placeholder="Have Multibanco?"><br>
          <label for="RestaurantOutdoorSeating">Have Outdoor Siting</label>
          <input class="form-control"type="text"  id="RestaurantOutdoorSeating" name="RestaurantOutdoorSeating" min="0" max="1"  placeholder="Have Outdoor Siting"><br>
          <label for="Latitude">Latitude</label>
          <input class="form-control"type="text"  id="RestaurantLatitude" name="RestaurantLatitude" placeholder="Latitude"><br>
          <label for="Longitude">Longitude</label>
          <input class="form-control"type="text" id="RestaurantLongitude" name="RestaurantLongitude" placeholder="Longitude"><br>
<div class="container">
      <?php echo validation_errors(); ?>
</div>
          <button class="btn btn-danger"type="submit">Update</button>
        </form>
</div>
<div>
<script src="<?php echo base_url().'assets/scripts/restaurant.js.'?>"> </script>
</div>
