angular.module('app.services')
    .service('ContextTreePath', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/contextpath/:id/', { id: '@id'}, {
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