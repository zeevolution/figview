angular.module('app.controllers')
    .controller('IotEnvListController', [
        '$scope', '$routeParams','IotEnv', 'ContextTreePath', '$location', function (
            $scope, $routeParams, IotEnv, ContextTreePath, $location) {

            $scope.iotenvs = [];
            $scope.iotEnvsPerPage = 5;
            $scope.totalIotEnvs = 0;

            $scope.pagination = {
                current: 1
            };

            $scope.pageChanged = function(newPage) {
                getResultsPage(newPage);
            };

            function getResultsPage(pageNumber) {
                IotEnv.query({
                    page: pageNumber
                }, function (data) {
                    $scope.iotenvs = data.data;
                    $scope.totalIotEnvs = data.meta.pagination.total;
                });
            }

            getResultsPage(1);

            $scope.cancel = function () {
                $location.path('/iotenvs/dashboard');
            };

        }]);
