angular.module('app.controllers')
    .controller('OrionDashboardController',
        ['$scope', '$location', '$cookies', '$routeParams','Orion',
            function ($scope, $location, $cookies, $routeParams, Orion) {
                $scope.orion = {

                };

                $scope.orions = [];
                $scope.orionsPerPage = 5;
                $scope.totalOrions = 0;

                $scope.pagination = {
                    current: 1
                };
                $scope.pageChanged = function(newPage) {
                    getResultsPage(newPage);
                };

                function getResultsPage(pageNumber) {
                    Orion.query({
                        orderBy: 'created_at',
                        sortedBy: 'desc',
                        page: pageNumber
                    }, function (data) {
                        $scope.orions = data.data;
                        $scope.orion = data.data[0];
                        $scope.totalOrions = data.meta.pagination.total;
                    });
                }

                getResultsPage(1);
                
                $scope.showOrion = function (orion) {
                    $scope.orion = orion;
                }
            }]);