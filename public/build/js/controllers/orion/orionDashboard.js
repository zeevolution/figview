angular.module('app.controllers')
    .controller('OrionDashboardController',
        ['$scope', '$location', '$cookies', '$routeParams','Orion', '$http',
            function ($scope, $location, $cookies, $routeParams, Orion, $http) {
                $scope.orion = {

                };

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
                        orderBy: 'created_at',
                        sortedBy: 'desc',
                        page: pageNumber
                    }, function (data) {
                        $scope.orions = data.data;
                        $scope.orion = data.data[0];
                        $scope.totalOrions = data.meta.pagination.total;
                    });
                }

                getResultsPage(1);
                
                $scope.showOrion = function (orion) {
                    $scope.orion = orion;
                };
                
                $scope.getOrionVersion = function () {
                    /**
                    var data = null;
                    var xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;

                    xhr.addEventListener("readystatechange", function () {
                        if (this.readyState === 4) {
                            console.log(this.responseText);
                        }
                    });

                    xhr.open("GET", "http://192.168.1.23:1026/version");
                    xhr.setRequestHeader("Accept", "application/json");
                    //xhr.setRequestHeader("Content-Type", "undefined");

                    xhr.send(data);
                     */

                    var settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": $scope.orion.orion_url_port + "version",
                        "method": "GET",
                        "headers": {
                            "Accept": "application/json"
                        }
                    };

                    //$.when( $.ajax(settings) ).then(function( data, textStatus, jqXHR ) {
                    //    alert(jqXHR.status); // Alerts 200
                    //});
                    //$.ajax(settings).done(function (response) {
                    //    console.log(response);
                    //    return response;
                    //});

                    $.ajax(settings).then(function (response) {
                        console.log(response);
                        $scope.orionVersion = response;
                        $scope.orionStatus = "Orion Up and Running";

                    }, function(error, textStatus){
                        console.log(textStatus);
                        $scope.orionStatus = textStatus + "! Orion Server is not responding...";
                    });
                };

                $scope.resetOrionVersionConnection = function () {
                    $scope.orionVersion = {
                    };
                    $scope.orionStatus = "";
                };
                
            }]);