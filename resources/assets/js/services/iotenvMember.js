angular.module('app.services')
    .service('IoTEnvMember', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/iotenv/:id/iotenvmember/:idIotEnvMember/', {
            id: '@id',
            idIotEnvMember: '@idIotEnvMember'
        }, {
            'query':  {
                method:'GET',
                isArray:true
            },
            'update': {
                method: 'PUT'
            },
            'delete': {
                method: 'DELETE'
            },
            'remove': {
                method: 'DELETE'
            }
        });
    }]);