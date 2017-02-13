angular.module('app.controllers')
    .controller('IotEnvListController', [
        '$scope', '$routeParams','IotEnv', function ($scope, $routeParams, IotEnv) {
            $scope.iotenvs = IotEnv.query();
        }]);