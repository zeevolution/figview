angular.module('app.services')
.service('Orion', ['$resource', 'appConfig', function ($resource, appConfig) {
    return $resource(appConfig.baseUrl + '/orion/', { id: '@id'}, {
        'query':  {
            method:'GET',
            isArray:false}
    });
}]);