angular.module('app.controllers')
    .controller('IoTEnvMemberRemoveController',
        ['$scope', '$location', '$cookies', '$routeParams','IoTEnvMember',
            function ($scope, $location, $cookies, $routeParams, IoTEnvMember) {
                $scope.iotenvMember = IoTEnvMember.get({
                    id: $routeParams.id,
                    idIotEnvMember: $routeParams.idIotEnvMember

                });

                $scope.remove = function () {
                    $scope.iotenvMember.$delete({
                        id: $routeParams.id,
                        idIotEnvMember: $routeParams.idIotEnvMember
                    }).then(function(){
                        $location.path('/iotenvs/dashboard');
                    });
                }
            }]);