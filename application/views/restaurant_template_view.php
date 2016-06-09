<div class="container">

<div class="row">


           <div class="col-xs-12 col-sm-6 col-md-8">

                <h4><a href="#"><?php echo $row->RESTAURANT_NAME; ?></a> </h4>
                <hr />
                    <img class="img-responsive" src="<?php echo base_url().'assets/images/restaurantes/'.
                    $row->RESTAURANT_IMAGE ?>" alt="<?php echo base_url().'assets/images/'. $row->RESTAURANT_NAME ?>" >

               </div>

<?php //Change Binary to Yes/No
 if ($row->RESTAURANT_WIFI == '1')
 {
    $wifi = 'Yes';
 }

 else{
    $wifi = 'No';
 }
 if ($row->RESTAURANT_DELIVERY == '1')
 {
    $delivery = 'Yes';
 }

 else{
    $delivery = 'No';
 }
 if ($row->RESTAURANT_MULTIBANCO == '1')
 {
    $multibanco = 'Yes';
 }

 else{
    $multibanco = 'No';
 }
 if ($row->RESTAURANT_OUTDOOR_SEATING == '1')
 {
    $outdoor_seating = 'Yes';
 }

 else{
    $outdoor_seating = 'No';
 }
 ?>
<div class="col-xs-6 col-md-4">
    <h2>Restaurant Info:</h2>
    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Name: <?php echo $row->RESTAURANT_NAME ?></strong></div>

      </div>

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
        switch ($stars)
        {
        case  "1":
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo " 1 Star ";
                  break;
        case "2":
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo " 2 Stars ";
                  break;
        case "3":
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo " 3 Stars ";
                  break;
        case "4":
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo " 4 Stars ";
                  break;
        default:
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo "<span class='glyphicon glyphicon-star'></span>";
                  echo " 5 Stars ";
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
</div> <!--end row-->

<div id="row">
 <div class="col-xs-12 col-sm-6 col-md-8">
    <hr />
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec enim id tellus porttitor pharetra ut vel felis. Phasellus elementum felis ligula, et commodo odio lacinia at. Praesent quis nibh dapibus, mollis tellus vitae, lobortis ligula. Nunc facilisis odio quis lectus consectetur, a viverra velit posuere. Pellentesque convallis venenatis ex, id rhoncus nunc condimentum eu. Pellentesque iaculis sit amet justo et sollicitudin. Nunc gravida elit in cursus eleifend. Aliquam eget elit ut quam ultrices commodo. Suspendisse potenti. Cras dui est, finibus vulputate blandit ut, interdum a turpis.

    Cras nec eros non metus pellentesque pulvinar eu nec mauris. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus rhoncus tempus turpis sit amet egestas. Suspendisse orci libero, facilisis id volutpat sit amet, mattis at dui. Ut et quam in dui lacinia blandit. Vestibulum vel lectus et lorem vulputate consectetur eget ut urna. Aenean vel est rhoncus, sollicitudin est eget, viverra tellus.

    Donec faucibus arcu sed urna finibus, dapibus auctor dui malesuada. In pharetra ultrices eros ac efficitur. Sed sit amet nisl sollicitudin justo porttitor lobortis a et libero. Nunc a nisl metus. Aenean eros nisl, mollis consectetur sodales quis, semper in justo. Proin posuere metus a sollicitudin vehicula. Vestibulum scelerisque augue felis, venenatis iaculis augue fringilla eu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis posuere semper dignissim. Vestibulum convallis in tellus quis iaculis. Nam quis quam fringilla, iaculis nibh vitae, lobortis augue. Cras accumsan eu leo sed fermentum. Phasellus ut lorem in tortor rhoncus porta. Sed blandit volutpat magna.

    Pellentesque maximus justo elementum, porttitor quam laoreet, commodo nisi. Vivamus consequat malesuada ultricies. Ut condimentum eget sem in mollis. Proin laoreet odio leo, a iaculis enim pellentesque sed. Morbi vehicula aliquam velit id pharetra. Pellentesque sed commodo est, sit amet vehicula nisl. Sed ac mauris diam. In ornare turpis sit amet dapibus faucibus. Aliquam erat volutpat.

    Etiam placerat mauris id ullamcorper iaculis. Proin eget turpis et ligula sagittis ultricies. Vestibulum vulputate malesuada eleifend. Suspendisse feugiat sapien a orci tincidunt elementum. Nam hendrerit egestas tempor. Aliquam ac urna risus. Aliquam eget placerat magna. Aliquam vitae cursus enim. Fusce bibendum quis sem a blandit. Aliquam odio ex, laoreet quis ipsum ut, mollis cursus augue. Sed et dignissim eros. Nulla at tristique augue. Fusce non pharetra arcu. Morbi elementum lacus eu fringilla tristique. Donec laoreet id mauris ac efficitur.
  </div>
  <div class="col-xs-6 col-md-4" id="map">
    <!--GOogle maps Here-->
  </div>
</div>
</div>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="<?php echo base_url().'assets/scripts/googlemaps.js.'?>"> </script>


   <!-- /.container -->
