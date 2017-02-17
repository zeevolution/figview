angular.module('app.controllers')
    .controller('IotEnvListController', [
        '$scope', '$routeParams','IotEnv', 'ContextTreePath', function ($scope, $routeParams, IotEnv, ContextTreePath) {
            $scope.iotenvs = IotEnv.query();
        }]);