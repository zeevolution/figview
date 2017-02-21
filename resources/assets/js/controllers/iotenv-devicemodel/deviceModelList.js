angular.module('app.controllers')
    .controller('DeviceModelListController', [
        '$scope', '$routeParams','DeviceModel', function ($scope, $routeParams, DeviceModel) {

        $scope.devicemodels = [];
        $scope.iotenvDeviceModelsPerPage = 10;
        $scope.totalIotenvDeviceModels = 0;

        $scope.pagination = {
            current: 1
        };

        $scope.pageChanged = function(newPage) {
           getResultsPage(newPage);
        };

        function getResultsPage(pageNumber) {
            DeviceModel.query({
               id: $routeParams.id, page: pageNumber}, function (data) {
                $scope.devicemodels = data.data;
                $scope.totalIotenvDeviceModels = data.meta.pagination.total;
            });
        }

        getResultsPage(1);

    }]);