angular.module('app.controllers')
    .controller('IotEnvNewController',
        ['$scope', '$location', '$cookies', '$q','IotEnv', 'Orion', 'Idas',
            function ($scope, $location, $cookies, $q, IotEnv, Orion, Idas) {
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
                        return model.idas_url_port;
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