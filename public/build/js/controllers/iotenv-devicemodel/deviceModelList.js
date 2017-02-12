angular.module('app.controllers')
    .controller('DeviceModelListController', [
        '$scope', '$routeParams','DeviceModel', function ($scope, $routeParams, DeviceModel) {
        $scope.devicemodels = DeviceModel.query({id: $routeParams.id});
    }]);