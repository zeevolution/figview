angular.module('app.controllers')
    .controller('IdasRemoveController',
        ['$scope', '$location', '$cookies', '$routeParams','Idas',
            function ($scope, $location, $cookies, $routeParams, Idas) {
                $scope.idas = Idas.get({id: $routeParams.id});

                $scope.remove = function () {
                    $scope.idas.$delete({id: $scope.idas.idas_id}).then(function(){
                        $location.path('/idas');
                    });
                }
            }]);