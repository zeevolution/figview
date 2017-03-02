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
                };

                $scope.idasVersion = {

                };

                $scope.idasStatus = "";

                $scope.getIdasInfo = function(){
                    var settings = {
                        "async": false,
                        "crossDomain": false,
                        "url": "http://192.168.1.12:8000/idas/version/NULL",
                        "method": "GET",
                        "headers": {
                        },
                        "data": "url=" + $scope.idas.idas_url_adminport
                    };

                    $.ajax(settings).then(function (response) {
                        //console.log(response);
                        var jsonObject = JSON.parse(response);
                        console.log(jsonObject);
                        $scope.idasVersion = jsonObject;
                        $scope.idasStatus = "Idas Service Up and Running";
                    }, function(error, textStatus){
                        //console.log(error);
                        $scope.idasStatus = "Error " + error.status + ": " + error.statusText +
                            ". Idas Server is not responding...";
                    });

                }

            }]);