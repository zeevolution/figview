angular.module('app.controllers')
    .controller('IdasDashboardController',
        ['$scope', '$location', '$cookies', '$routeParams','Idas',
            function ($scope, $location, $cookies, $routeParams, Idas) {
                $scope.idas = {

                };

                $scope.allIdas = [];
                $scope.idasPerPage = 5;
                $scope.totalIdas = 0;

                $scope.pagination = {
                    current: 1
                };
                $scope.pageChanged = function(newPage) {
                    getResultsPage(newPage);
                };

                function getResultsPage(pageNumber) {
                    Idas.query({
                        orderBy: 'created_at',
                        sortedBy: 'desc',
                        page: pageNumber
                    }, function (data) {
                        $scope.allIdas = data.data;
                        $scope.idas = data.data[0];
                        $scope.totalIdas = data.meta.pagination.total;
                    });
                }

                getResultsPage(1);

                $scope.showIdas = function (idas) {
                    $scope.idas = idas;
                }
            }]);