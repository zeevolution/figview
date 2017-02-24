angular.module('app.controllers')
    .controller('DeviceModelRemoveController',
        ['$scope', '$location', '$cookies', '$routeParams','DeviceModel',
            function ($scope, $location, $cookies, $routeParams, DeviceModel) {
                $scope.devicemodel = DeviceModel.get({
                    id: $routeParams.id,
                    idDeviceModel: $routeParams.idDeviceModel
                });

                $scope.remove = function () {
                    $scope.devicemodel.$delete({
                        id: $routeParams.id, idDeviceModel: $scope.devicemodel.model_id}).then(function(){
                        //$location.path('/iotenv/' + $routeParams.id + '/devicemodels');
                        $location.path('iotenvs/dashboard');
                    });
                }
            }]);