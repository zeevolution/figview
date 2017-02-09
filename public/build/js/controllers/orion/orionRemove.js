angular.module('app.controllers')
    .controller('OrionRemoveController',
        ['$scope', '$location', '$cookies', '$routeParams','Orion',
            function ($scope, $location, $cookies, $routeParams, Orion) {
                $scope.orion = Orion.get({id: $routeParams.id});

                $scope.remove = function () {
                    $scope.orion.$delete({id: $scope.orion.data.orion_id}).then(function(){
                       $location.path('/orions');
                    });
                }
            }]);