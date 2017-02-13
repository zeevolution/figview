angular.module('app.controllers')
    .controller('IotEnvEditController',
        ['$scope', '$location', '$cookies', '$routeParams','IotEnv', 'Orion', 'Idas',
            function ($scope, $location, $cookies, $routeParams, IotEnv, Orion, Idas) {
                $scope.iotenv = IotEnv.get({id: $routeParams.id});
                $scope.orions = Orion.query();
                $scope.idas = Idas.query();

                $scope.save = function () {
                    if($scope.form.$valid) {
                        $scope.iotenv.user_id = $cookies.getObject('user').user_id;
                        IotEnv.update({id: $scope.iotenv.id}, $scope.iotenv, function () {
                            $location.path('/iotenvs');
                        });
                    }
                }
            }]);