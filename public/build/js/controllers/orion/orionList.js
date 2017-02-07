angular.module('app.controllers')
    .controller('OrionListController', ['$scope', 'Orion', function ($scope, Orion) {
        $scope.orions = Orion.query();
    }]);