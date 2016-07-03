var app = angular.module('myApp', []);
app.controller('dishesCtrl', function($scope, $http) {
    $("#SelectMenu").change(function() {
        $scope.id = $(this).find("option:selected").val();
        console.log($scope.id);
    $http.get('http://192.168.1.18/dw/rest/menu_info/' + $scope.id)
      .then(function(response) {
          $scope.info = response.data;
            });
    });
});
