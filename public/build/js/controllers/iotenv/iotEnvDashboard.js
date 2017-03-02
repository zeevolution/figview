angular.module('app.controllers')
    .controller('IotEnvDashboardController',
        ['$scope', '$location', '$cookies', '$routeParams','IotEnv', 'IoTEnvMember', 'User', 'DeviceModel',
            function ($scope, $location, $cookies, $routeParams, IotEnv, IoTEnvMember, User, DeviceModel) {
                $scope.iotenv = {

                };

                $scope.iotDevices = {

                };

                $scope.device_id = '';
                $scope.entity_id = '';
                $scope.model_json = '';



                $scope.iotenvs = [];
                $scope.iotenvsPerPage = 6;
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

                $scope.registerNewDevice =function (model, device, entity) {
                    //console.log(model);
                    //console.log(device);
                    //console.log(entity);

                    var jsonModelObject= JSON.parse(model);

                    jsonModelObject.devices[0].entity_name = entity;
                    jsonModelObject.devices[0].device_id = device;

                    $scope.model_json = JSON.stringify(jsonModelObject);

                    //console.log(jsonModelObject);
                    //console.log($scope.model_json);

                    var settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": $scope.iotenv.idas.data.idas_url_adminport + "iot/devices",
                        "method": "POST",
                        "headers": {
                            "fiware-service": $scope.iotenv.Fiware_Service,
                            "content-type": $scope.iotenv.content_type,
                            "fiware-servicepath": $scope.iotenv.Fiware_ServicePath,
                            "x-auth-token": $scope.iotenv.X_Auth_Token,
                        },
                        "processData": false,
                        "data": $scope.model_json
                    };


                    $.ajax(settings).then(function (response) {
                        alert("Device Registered!");

                    }, function(error){
                        alert(error.responseJSON.message);
                    });


                };
                
                $scope.eraseRegisterDeviceForm = function () {
                    $scope.addemp = {};
                };

                $scope.deviceId = '';
                $scope.measurement = '';

                $scope.sendDataObservations = function (deviceId, measurement) {
                    //console.log(deviceId);
                    //console.log(measurement);

                    var settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": $scope.iotenv.idas.data.idas_url_ul20port +
                        "iot/d?k="+ $scope.iotenv.X_Auth_Token + "&i=" + deviceId,
                        "method": "POST",
                        "headers": {
                            "fiware-service": $scope.iotenv.Fiware_Service,
                            "content-type": "text/plain",
                            "fiware-servicepath": $scope.iotenv.Fiware_ServicePath,
                            "x-auth-token": $scope.iotenv.X_Auth_Token,
                        },
                        "data": measurement
                    };

                    $.ajax(settings).then(function (response) {
                        alert("Your measurement was sent successfully! Check the data at the corresponding Orion Entity");

                    }, function(error){
                        alert("Error sending the data. Check you token access, and make sure all your Fiware IoT Services are working properly.");
                    });
                };

                $scope.eraseSendObservationForm = function () {
                    $scope.addemp = {};
                };

            }]);