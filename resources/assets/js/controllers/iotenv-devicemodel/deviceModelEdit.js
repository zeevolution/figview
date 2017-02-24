angular.module('app.controllers')
    .controller('DeviceModelEditController',
        ['$scope', '$location', '$cookies', '$routeParams','DeviceModel',
            function ($scope, $location, $cookies, $routeParams, DeviceModel) {
                $scope.devicemodel = DeviceModel.get({
                    id: $routeParams.id,
                    idDeviceModel: $routeParams.idDeviceModel
                });

                $scope.save = function () {
                    if($scope.form.$valid) {
                        DeviceModel.update({id: $routeParams.id, idDeviceModel: $scope.devicemodel.model_id}, $scope.devicemodel, function () {
                            //$location.path('/iotenv/' + $routeParams.id + '/devicemodels');
                            $location.path('iotenvs/dashboard');
                        });
                    }
                }
            }]);