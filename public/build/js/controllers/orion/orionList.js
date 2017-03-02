angular.module('app.controllers')
    .controller('OrionListController', ['$scope', 'Orion', '$location', function ($scope, Orion, $location) {
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
                page: pageNumber
            }, function (data) {
                $scope.orions = data.data;
                $scope.totalOrions = data.meta.pagination.total;
            });
        }

        getResultsPage(1);

        $scope.cancel = function () {
            $location.path('/orions/dashboard');
        };

        $scope.goToNewOrionForm = function () {
            $location.path('/orions/new');
        };

    }]);