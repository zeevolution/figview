angular.module('app.controllers')
    .controller('OrionEditController',
        ['$scope', '$location', '$cookies', '$routeParams','Orion',
            function ($scope, $location, $cookies, $routeParams, Orion) {
        $scope.orion = Orion.get({id: $routeParams.id});

        $scope.save = function () {
            if($scope.form.$valid) {
                Orion.update({id: $scope.orion.data.orion_id}, $scope.orion.data, function () {
                    $location.path('/orions');
                });
            }
        }
    }]);