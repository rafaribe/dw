var app = angular.module('myApp', []);
app.controller('dishesCtrl', function($scope, $http) {
    $http.get("http://192.168.130.145/dw/rest/menu_info")
    .then(function (response) {$scope.info = response.data;});
});
