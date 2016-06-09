<div class="container">

       <div class="row">


           <div class="col-md-9">

               <div class="thumbnail">
   <img class="img-responsive" src="<?php echo base_url().'assets/images/restaurantes/'. $row->RESTAURANT_IMAGE ?>" alt="<?php echo base_url().'assets/images/'. $row->RESTAURANT_NAME ?>" >
                   <div class="caption-full">
                       <h4 class="pull-right"><?php echo $row->RESTAURANT_ADDRESS ?></h4>
                       <h4><a href="#"><?php echo $row->RESTAURANT_NAME; ?></a> </h4>

                   </div>
                   <div class="ratings">

                       <p class="pull-right">3 reviews</p>
                       <p>
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

                       </p>
                   </div>
               </div>

               <div class="well">

                   <div class="text-right">
                       <a class="btn btn-success">Leave a Review</a>
                   </div>

                   <hr>

                   <div class="row">
                       <div class="col-md-12">
                         <?php  ?>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star-empty"></span>
                           Anonymous
                           <span class="pull-right">10 days ago</span>
                           <p>This product was great in terms of quality. I would definitely buy another!</p>
                       </div>
                   </div>

                   <hr>

                   <div class="row">
                       <div class="col-md-12">
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star-empty"></span>
                           Anonymous
                           <span class="pull-right">12 days ago</span>
                           <p>I've alredy ordered another one!</p>
                       </div>
                   </div>

                   <hr>

                   <div class="row">
                       <div class="col-md-12">
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star"></span>
                           <span class="glyphicon glyphicon-star-empty"></span>
                           Anonymous
                           <span class="pull-right">15 days ago</span>
                           <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                       </div>
                   </div>

               </div>

           </div>

       </div>

   </div>
   <!-- /.container -->
