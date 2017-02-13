angular.module('app.services')
    .service('IotEnv', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/iotenv/:id/', {id: '@id'},
        {
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