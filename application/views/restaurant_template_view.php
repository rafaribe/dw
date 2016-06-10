<div class="container">

<div class="row">
           <div class="col-xs-12 col-sm-4 col-md-4  ">

                <h2><a href="#"><?php echo $row->RESTAURANT_NAME; ?></a> </h2>
                <hr />
                    <img class="img-responsive" src="<?php echo base_url().'assets/images/restaurantes/'.
                    $row->RESTAURANT_IMAGE ?>" alt="<?php echo base_url().'assets/images/'.$row->RESTAURANT_NAME ?>" >

               </div>

               <?php
               $latitude = $row->LATITUDE;
               $longitude = $row->LONGITUDE;
               ?>
<div id="latitude" name="<?php echo $latitude;?>"></div>
<div id="longitude" name="<?php echo $longitude;?>"></div>

<?php //Change Binary to Yes/No

 if ($row->RESTAURANT_WIFI == '1') {
     $wifi = 'Yes';
 } else {
     $wifi = 'No';
 }
 if ($row->RESTAURANT_DELIVERY == '1') {
     $delivery = 'Yes';
 } else {
     $delivery = 'No';
 }
 if ($row->RESTAURANT_MULTIBANCO == '1') {
     $multibanco = 'Yes';
 } else {
     $multibanco = 'No';
 }
 if ($row->RESTAURANT_OUTDOOR_SEATING == '1') {
     $outdoor_seating = 'Yes';
 } else {
     $outdoor_seating = 'No';
 }

 ?>

 <?php
 //function to read a clob
 function read_clob($field)
 {
     return $field->read($field->size());
 }
?>


<div class="col-xs-12 col-sm-4 col-md-4">
    <h2>Restaurant Info:</h2><hr />
    <div class="panel-group">

      <div class="panel panel-primary">
        <div class="panel-heading"><strong>Address:  <?php echo $row->RESTAURANT_ADDRESS ?></strong></div>

      </div>

      <div class="panel panel-success">
        <div class="panel-heading"><strong>Wifi: <?php echo $wifi ?></strong></div>
      </div>

      <div class="panel panel-info">
        <div class="panel-heading"><strong>Delivers Home: <?php echo $delivery ?></strong></div>
      </div>

      <div class="panel panel-warning">
        <div class="panel-heading"><strong>Have Multibanco: <?php echo $multibanco ?></strong></div>
      </div>

      <div class="panel panel-danger">
        <div class="panel-heading"><strong>Outdoor Seating: <?php echo $outdoor_seating ?></strong></div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading"><strong>Raw Score: <?php echo $row->RESTAURANT_POINTS ?></strong></div>
      </div>

      <div class="panel panel-primary">
        <div class="panel-heading"><strong>Star Score: <?php
        $stars = round($row->RESTAURANT_POINTS);
        switch ($stars) {
        case  '1':
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo ' 1 Star ';
                  break;
        case '2':
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo ' 2 Stars ';
                  break;
        case '3':
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo ' 3 Stars ';
                  break;
        case '4':
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo ' 4 Stars ';
                  break;
        default:
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo ' 5 Stars ';
                  break;
        }

        ?>
      </strong></div>
      </div>

      <div class="panel panel-success">
        <div class="panel-heading"><strong>Coordinates:  <?php echo $row->LATITUDE; echo ' '; echo $row->LONGITUDE ?></strong></div>
      </div>


    </div>


   </div>
   <div class="col-xs-12 col-sm-4 col-md-4">
        <h2>Google Maps:</h1>
        <hr />
 <div id="map" style="width:350px;height:350px;"></div>
</div> <!--end row-->
</div>
<hr />
<div class="row">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<h2>Comments</h2>
<div ng-app="App">

  <div class="form-group" >
    <form method="POST" action="Restaurants/comments">
    <label for="comment">Insert a Comment</label>
    <input type="text" class="form-control input-lg" id="comment" placeholder="leave a comment"><br>
      <label for="comment">Leave a Rating</label>
    <input type="number" class="form-control input-sm" id="rating" placeholder="Choose the rating"><br>
    <button class="btn btn-success"type="submit">Comment</button>
  </form>
  </div>
  <div>
<?php foreach ($comment as $cmt): ?>
<div class="jumbotron">
  <div class="alert alert-success" role="alert"><?php $cmt->USER_NAME; ?></div>

  <?php echo read_clob($cmt->COMMENT_TEXT); ?>
</div>
    <?php endforeach; ?>
</div>
</div>
</div>
</div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDo4YgAUj6Az43mY02t84xwPEWxDjtQApI"></script>
<script src="<?php echo base_url().'assets/scripts/googlemaps.js.'?>"> </script>


   <!-- /.container -->
