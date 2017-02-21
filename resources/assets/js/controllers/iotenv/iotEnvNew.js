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
                            $location.path('/iotenvs/dashboard');
                        }, function (data) {
                            $scope.error.error = true;
                            $scope.error.message = data.message;
                        });
                    }
                };

                $scope.cancel = function () {
                    $location.path('/iotenvs/dashboard');
                };

                $scope.formatOrionUrl = function(model) {
                    if(model){
                        return model.orion_url_port;
                    }
                    return '';

                };

                $scope.getOrions = function(orionUrl){
                    return Orion.query({
                        search: orionUrl,
                        searchFields: 'url:like'

                    }).$promise;
                };

                $scope.selectOrion = function (item){
                    $scope.iotenv.orion_id = item.orion_id;
                };

                $scope.formatIdasUrl = function(model) {
                    if(model){
                        return model.idas_url_port;
                    }
                    return '';

                };

                $scope.getIdas = function(idasUrl){
                    return Idas.query({
                        search: idasUrl,
                        searchFields: 'url:like'

                    }).$promise;
                };

                $scope.selectIdas = function (item){
                    $scope.iotenv.idas_id = item.idas_id;
                };

            }]);