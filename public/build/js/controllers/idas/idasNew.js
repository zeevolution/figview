angular.module('app.controllers')
    .controller('IdasNewController', ['$scope', '$location', '$cookies', 'Idas', function ($scope, $location, $cookies, Idas) {
        $scope.idas = new Idas();

        $scope.error = {
            message: '',
            error: false
        };

        $scope.save = function () {
            if($scope.form.$valid) {
                $scope.idas.user_id = $cookies.getObject('user').user_id;
                $scope.idas.$save().then(function () {
                    $location.path('/idas/dashboard');

                }, function (data) {
                    $scope.error.error = true;
                    $scope.error.message = data.data.error_description;
                });
            }
        }
    }]);