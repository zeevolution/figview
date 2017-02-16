angular.module('app.controllers')
    .controller('IoTEnvMemberListController', [
        '$scope', '$routeParams','IoTEnvMember', 'User', function ($scope, $routeParams, IoTEnvMember, User) {
            $scope.iotenvMember = new IoTEnvMember();

            $scope.save = function () {
                if($scope.form.$valid)
                {
                    $scope.iotenvMember.$save({id: $routeParams.id}).then(function (){
                        $scope.iotenvMember = new IoTEnvMember();
                        $scope.loadMember();
                    });
                }
            };

            $scope.loadMember = function (){
                $scope.iotenvMembers = IoTEnvMember.query({
                    id: $routeParams.id,
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

            $scope.loadMember();

        }]);