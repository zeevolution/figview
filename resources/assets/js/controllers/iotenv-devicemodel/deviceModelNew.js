angular.module('app.controllers')
    .controller('DeviceModelNewController',
        ['$scope', '$location', '$cookies', '$routeParams','DeviceModel',
            function ($scope, $location, $cookies, $routeParams,DeviceModel) {
        $scope.devicemodel = new DeviceModel();
        $scope.devicemodel.iotenv_id = $routeParams.id;

        $scope.error = {
            message: '',
            error: false
        };

        $scope.save = function () {
            if($scope.form.$valid) {
                $scope.devicemodel.$save({id: $routeParams.id}).then(function () {
                    //$location.path('/iotenv/' + $routeParams.id + '/devicemodels');
                    $location.path('/iotenvs/dashboard');
                }, function (data) {
                    $scope.error.error = true;
                    $scope.error.message = data.message;
                });
            }
        }
    }]);