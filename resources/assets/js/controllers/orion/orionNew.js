angular.module('app.controllers')
    .controller('OrionNewController', ['$scope', '$location', '$cookies', 'Orion', function ($scope, $location, $cookies, Orion) {
        $scope.orion = new Orion();

        $scope.error = {
            message: '',
            error: false
        };

        $scope.save = function () {
            if($scope.form.$valid) {
                $scope.orion.user_id = $cookies.getObject('user').data.user_id;
                $scope.orion.$save().then(function () {
                    $location.path('/orions');

                }, function (data) {
                    $scope.error.error = true;
                    $scope.error.message = data.data.error_description;
                });
            }
        }
    }]);