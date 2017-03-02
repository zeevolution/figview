angular.module('app.controllers')
    .controller('HomeController',
        ['$scope', '$cookies', '$location', 'IotEnv',
            function ($scope, $cookies, $location, IotEnv) {
        //console.log($cookies.getObject('user').user_email);

        $scope.iotenvs =[];

        $scope.iotEnvsPerPage = 6;
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


        $scope.goToNewIoTForm = function (iotenv) {
            console.log(iotenv);
            $location.path('#/iotenvs/{{ iotenv.id }}/edit');
        };

    }]);