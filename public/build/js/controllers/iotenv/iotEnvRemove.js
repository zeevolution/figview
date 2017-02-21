angular.module('app.controllers')
    .controller('IotEnvRemoveController',
        ['$scope', '$location', '$cookies', '$routeParams','IotEnv',
            function ($scope, $location, $cookies, $routeParams, IotEnv) {
                $scope.iotenv = IotEnv.get({id: $routeParams.id});

                $scope.remove = function () {
                    $scope.iotenv.$delete({id: $scope.iotenv.id}).then(function(){
                        $location.path('/iotenvs/dashboard');
                    });
                }
            }]);