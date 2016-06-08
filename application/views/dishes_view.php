<!-- Page Content -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css"/>
<!--<script src="<?php echo base_url();?>assets/scripts/restaurant.js"></script>-->
<!-- Projects Row -->
<div>

       <div class="row" id="div-row1">
           <?php foreach($list as $data): ?>
           <div class="col-md-4 portfolio-item">
               <a href="#">
                   <img class="img-responsive" src="<?php echo base_url().'assets/images/dishes/'. $data->DISH_IMAGE ?>" alt="<?php echo base_url().'assets/images/'. $data->DISH_NAME ?>"  width="700" height="400">
               </a>
               <h3>
                   <a href="<?php echo base_url().'DISHES/'. $data->DISH_ID ?>"><?php echo $data->DISH_NAME ?></a>
               </h3>

           </div>

  <?php endforeach ?>
    </div>
      </div>
    <!-- /.container -->
