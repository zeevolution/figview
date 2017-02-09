angular.module('app.controllers')
    .controller('IdasListController', ['$scope', 'Idas', function ($scope, Idas) {
        $scope.idas = Idas.query();
    }]);