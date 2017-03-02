angular.module('app.controllers')
    .controller('IdasEditController',
        ['$scope', '$location', '$cookies', '$routeParams','Idas',
            function ($scope, $location, $cookies, $routeParams, Idas) {
                $scope.idas = Idas.get({id: $routeParams.id});

                $scope.save = function () {
                    if($scope.form.$valid) {
                        Idas.update({id: $scope.idas.idas_id}, $scope.idas, function () {
                            $location.path('/idas/dashboard');
                        });
                    }
                };

                $scope.cancel = function () {
                    $location.path('/idas/dashboard');
                };
                
            }]);