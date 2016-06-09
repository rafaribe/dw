<div class="container">

       <div class="row">


           <div class="col-xs-12 col-sm-6 col-md-8">

                <h4><a href="#"><?php echo $row->RESTAURANT_NAME; ?></a> </h4>
                    <img class="img-responsive" src="<?php echo base_url().'assets/images/restaurantes/'.
                    $row->RESTAURANT_IMAGE ?>" alt="<?php echo base_url().'assets/images/'. $row->RESTAURANT_NAME ?>" >

                    <h4><?php echo $row->RESTAURANT_ADDRESS ?></h4>


<hr />
                   <div class="ratings">
                         <?php
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
                   </div>

               </div>


<div class=".col-xs-6 .col-md-4">
  <h2>Restaurant Info:</h1>

  <h4> Restaurant Name: <?php echo $row->RESTAURANT_NAME ?> </h2> 
</div>
</div> <!--end row-->
</div>
   <!-- /.container -->
