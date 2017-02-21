angular.module('app.services')
    .service('DeviceModel', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/iotenv/:id/devicemodel/:idDeviceModel/', {
            id: '@id',
            idDeviceModel: '@idDeviceModel'
        }, {
            'query':  {
                method:'GET',
                isArray:false
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