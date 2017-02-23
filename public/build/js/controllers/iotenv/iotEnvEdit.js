angular.module('app.controllers')
    .controller('IotEnvEditController',
        ['$scope', '$location', '$cookies', '$q','$routeParams','IotEnv', 'Orion', 'Idas',
            function ($scope, $location, $cookies, $q,$routeParams, IotEnv, Orion, Idas) {
                IotEnv.get({id: $routeParams.id}, function (data) {
                    $scope.iotenv = data;
                    $scope.orionSelected = data.orion.data;
                    $scope.idasSelected = data.idas.data;
                });

                $scope.save = function () {
                    if($scope.form.$valid) {
                        $scope.iotenv.user_id = $cookies.getObject('user').user_id;
                        IotEnv.update({id: $scope.iotenv.id}, $scope.iotenv, function () {
                            $location.path('/iotenvs/dashboard');
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
                    var deffered = $q.defer();
                    Orion.query({
                        search: orionUrl,
                        searchFields: 'url:like'
                    }, function(data){
                        deffered.resolve(data.data);
                    }, function (error){
                        deffered.reject(error);
                    });

                    return deffered.promise;
                };

                $scope.selectOrion = function (item){
                    $scope.iotenv.orion_id = item.orion_id;
                };

                $scope.formatIdasUrl = function(model) {
                    if(model){
                        return model.url;
                    }
                    return '';

                };

                $scope.getIdas = function(idasUrl){
                    var deffered = $q.defer();
                    Idas.query({
                        search: idasUrl,
                        searchFields: 'url:like'
                    }, function (data) {
                        deffered.resolve(data.data);
                    }, function (error) {
                        deffered.reject(error);
                    });

                    return deffered.promise;
                };

                $scope.selectIdas = function (item){
                    $scope.iotenv.idas_id = item.idas_id;
                };


            }]);