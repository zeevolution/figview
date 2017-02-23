angular.module('app.controllers')
    .controller('IotEnvDashboardController',
        ['$scope', '$location', '$cookies', '$routeParams','IotEnv', 'IoTEnvMember', 'User', 'DeviceModel',
            function ($scope, $location, $cookies, $routeParams, IotEnv, IoTEnvMember, User, DeviceModel) {
                $scope.iotenv = {

                };

                $scope.iotDevices = {

                };



                $scope.iotenvs = [];
                $scope.iotenvsPerPage = 5;
                $scope.totalIotEnvs = 0;

                $scope.pagination = {
                    current: 1
                };
                $scope.pageChanged = function(newPage) {
                    getResultsPage(newPage);
                };

                function getResultsPage(pageNumber) {
                    IotEnv.query({
                        orderBy: 'created_at',
                        sortedBy: 'desc',
                        page: pageNumber
                    }, function (data) {
                        $scope.iotenvs = data.data;
                        $scope.iotenv = data.data[0];
                        $scope.loadMember(data.data[0].id);
                        $scope.loadDeviceModel(data.data[0].id);
                        $scope.totalIotEnvs = data.meta.pagination.total;
                    });
                }

                getResultsPage(1);

                $scope.showIotEnv = function (iotenv) {
                    $scope.iotenv = iotenv;
                    $scope.loadMember($scope.iotenv.id);
                    $scope.loadDeviceModel($scope.iotenv.id);
                };


                $scope.iotenvMember = new IoTEnvMember();

                $scope.save = function () {
                    //if($scope.form.$valid) //Error here: TypeError: Cannot read property '$valid' of undefined
                    //{
                        $scope.iotenvMember.$save({id: $scope.iotenv.id}).then(function (){
                            $scope.iotenvMember = new IoTEnvMember();
                            $scope.loadMember($scope.iotenv.id);
                        });
                    //}
                };

                $scope.loadMember = function (id){
                    $scope.iotenvMembers = IoTEnvMember.query({
                        id: id,
                        orderBy: 'id',
                        sortedBy:'asc'

                    });
                };

                $scope.loadDeviceModel = function (id){
                    $scope.devicemodels = DeviceModel.query({
                        id: id,
                        orderBy: 'id',
                        sortedBy:'asc'

                    });
                };

                $scope.formatName = function (model){
                    if(model){
                        return model.user_name;
                    }

                    return '';
                };

                $scope.getUsers = function (name){
                    return User.query({
                        search: name,
                        searchFields: 'name:like'

                    }).$promise;
                };

                $scope.selectUser = function (item){
                    $scope.iotenvMember.member_id = item.user_id;
                };

                $scope.reset = function() {
                    $scope.addemp = {};
                    $scope.form.$setPristine();
                };

                $scope.getIoTDevices = function () {
                    var settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": $scope.iotenv.idas.data.idas_url_adminport + "iot/devices",
                        "method": "GET",
                        "headers": {
                            "fiware-service": $scope.iotenv.Fiware_Service,
                            "content-type": $scope.iotenv.content_type,
                            "fiware-servicepath": $scope.iotenv.Fiware_ServicePath,
                            "x-auth-token": $scope.iotenv.X_Auth_Token,
                            "cache-control": "no-cache",
                            "postman-token": "40f5cd22-0f5d-6683-1ee0-59ed079f6b89"
                        }
                    };

                    $.ajax(settings).done(function (response) {
                        console.log(response);
                        $scope.iotDevices = response;
                    });

                };
                
                $scope.resetGetIoTDevices = function () {
                    $scope.iotDevices = {};
                };

            }]);