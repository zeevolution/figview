angular.module('app.controllers')
    .controller('IotEnvNewController',
        ['$scope', '$location', '$cookies','IotEnv', 'Orion', 'Idas',
            function ($scope, $location, $cookies, IotEnv, Orion, Idas) {
                $scope.iotenv = new IotEnv();
                $scope.orions = Orion.query();
                $scope.idas = Idas.query();


                $scope.error = {
                    message: '',
                    error: false
                };

                $scope.save = function () {
                    if($scope.form.$valid) {
                        $scope.iotenv.user_id = $cookies.getObject('user').user_id;
                        $scope.iotenv.$save().then(function () {
                            $location.path('/iotenvs');
                        }, function (data) {
                            $scope.error.error = true;
                            $scope.error.message = data.message;
                        });
                    }
                }
            }]);