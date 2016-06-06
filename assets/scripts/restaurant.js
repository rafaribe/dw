$(document).ready(function(){


$.getJSON('http://localhost/dw/rest/all_restaurants', function(restaurantes) {
  console.log(restaurantes.restaurant_name);
  });
    //data is the JSON string
});
