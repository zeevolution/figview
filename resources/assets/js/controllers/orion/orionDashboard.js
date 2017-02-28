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
                    var settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": $scope.orion.orion_url_port + "version",
                        "method": "GET",
                        "headers": {
                            "Accept": "application/json"
                            //"x-auth-token": $scope.orion.X_Auth_Token
                        }
                    };

                    $.ajax(settings).then(function (response) {
                        console.log(response);
                        $scope.orionVersion = response;
                        $scope.orionStatus = "Orion Up and Running";

                    }, function(error, textStatus){
                        console.log(error);
                        $scope.orionStatus = textStatus + ". " + error.responseText + ". Orion Server is not responding...";
                    });
                };

                $scope.resetOrionVersionConnection = function () {
                    $scope.orionVersion = {
                    };
                    $scope.orionStatus = "";
                };


                $scope.orionEntities = [];

                $scope.getEntitiesByService = function (fiware_service, X_Auth_Token) {
                    var settings = {
                        "async": false,
                        "crossDomain": false,
                        "url": "http://192.168.1.12:8000/orions/allEntities/" + fiware_service + '/' + X_Auth_Token,
                        "method": "GET",
                        "headers": {

                        },
                        "data": "url="+ $scope.orion.orion_url_port
                    };

                    $.ajax(settings).then(function (response) {
                        //console.log(response);
                        var jsonObject = JSON.parse(response);
                        console.log(jsonObject);
                        $scope.orionEntities = jsonObject.contextResponses;
                        $scope.entity_id = jsonObject.contextResponses[0].contextElement;
                        $scope.attributeTypeArray = $scope.entity_id;
                    }, function(error, textStatus){
                        console.log(textStatus);
                        alert (textStatus + ". "+ error.responseText + ". Orion Server is not responding...");
                    });
                };

                $scope.eraseGetOrionEntitiesByServiceForm = function () {
                    $scope.orionEntities = {
                    };
                };

                $scope.attributeTypeArray = [];

                $scope.setEntityAttributeArray = function () {
                    $scope.attributeTypeArray = $scope.entity_id;
                };

                $scope.attrArray = [];

                $scope.getEntityAttributeByService = function (fiware_service, entity_id, attribute_id, X_Auth_Token) {
                    var settings = {
                        "async": false,
                        "crossDomain": false,
                        "url": "http://192.168.1.12:8000/orions/"+ entity_id.id + "/attribute/"
                        + attribute_id + "/"
                        + fiware_service + '/' + X_Auth_Token,
                        "method": "GET",
                        "headers": {

                        },
                        "data": "url="+ $scope.orion.orion_url_port
                    };

                    $.ajax(settings).then(function (response) {
                        //console.log(response);
                        var jsonObject = JSON.parse(response);
                        console.log(jsonObject);
                        $scope.attrArray = jsonObject;
                    }, function(error, textStatus){
                        console.log(textStatus);
                        alert (textStatus + ". "+ error.responseText + ". Orion Server is not responding...");
                    });
                }
                
            }]);