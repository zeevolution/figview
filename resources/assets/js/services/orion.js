angular.module('app.services')
.service('Orion', ['$resource', 'appConfig', function ($resource, appConfig) {
    return $resource(appConfig.baseUrl + '/orion/:id/', { id: '@id'}, {
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