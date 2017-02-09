angular.module('app.services')
    .service('Idas', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/idas/:id/', { id: '@id'}, {
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