angular.module('app.controllers')
    .controller('IdasListController', ['$scope', 'Idas', function ($scope, Idas) {
        $scope.idas = [];
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
                page: pageNumber
            }, function (data) {
                $scope.idas = data.data;
                $scope.totalIdas = data.meta.pagination.total;
            });
        }

        getResultsPage(1);

    }]);