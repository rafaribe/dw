$("#SelectResaurant").change(function() {
            var x = $(this).find("option:selected").val();
console.log(x);
                $.ajax({
                type: "POST",
                url: "restaurant_ajax",
                data: {
                    restaurant_id: x
                },

                success: function(result) {
                    var resultado = JSON.parse(result);
                    console.log (resultado[0]);
                    $("#RestaurantName").val(resultado[0].RESTAURANT_NAME);
                    $("#RestaurantAddress").val(resultado[0].RESTAURANT_ADDRESS);
                    $("#RestaurantReservations").val(resultado[0].RESTAURANT_RESERVATIONS);
                    $("#RestaurantWifi").val(resultado[0].RESTAURANT_WIFI);
                    $("#RestaurantDelivery").val(resultado[0].RESTAURANT_DELIVERY);
                    $("#RestaurantMultibanco").val(resultado[0].RESTAURANT_MULTIBANCO);
                    $("#RestaurantOutdoorSeating").val(resultado[0].RESTAURANT_OUTDOOR_SEATING);
                }
            });
    });
    $("#SelectDish").change(function() {
                var x = $(this).find("option:selected").val();
    console.log(x);
                    $.ajax({
                    type: "POST",
                    url: "dish_ajax",
                    data: {
                        dish_id: x
                    },

                    success: function(result) {
                        var resultado = JSON.parse(result);
                        console.log (resultado[0]);
                        $("#DishName").val(resultado[0].DISH_NAME);
                        $("#DishType").val(resultado[0].DISH_TYPE);

                    }
                });
        });
