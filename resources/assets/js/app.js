var app = angular.module('app',[
    'ngRoute', 'angular-oauth2','app.controllers', 'app.services', 'app.directives',
    'ui.bootstrap.typeahead', 'ui.bootstrap.tpls', 'treeGrid',
    'ui.tree', 'http-auth-interceptor', 'ui.bootstrap.modal', 'angularUtils.directives.dirPagination',
    'mgcrea.ngStrap.navbar', 'ui.bootstrap.dropdown', 'ui.bootstrap.tabs' ]);

angular.module('app.controllers',['ngMessages','angular-oauth2']);
angular.module('app.services',['ngResource']);
angular.module('app.directives',['ngResource']);

app.provider('appConfig', function () {
    var config = {
        baseUrl: "http://localhost:8000",
        utils: {
            transformResponse: function (data, headers) {
                var headersGetter = headers();
                if(headersGetter['content-type'] == 'application/json' ||
                    headersGetter['content-type'] == 'text/json') {

                    var dataJson = JSON.parse(data);
                    if(dataJson.hasOwnProperty('data') && Object.keys(dataJson).length == 1){
                        dataJson = dataJson.data;
                    }
                    return dataJson;

                }
                return data;
            }
        }

    };

    return {
        config: config,
        $get: function () {
            return config;
        }
    }

});

app.config([
    '$routeProvider', '$httpProvider','OAuthProvider',
    'OAuthTokenProvider','appConfigProvider',
    function ($routeProvider, $httpProvider, OAuthProvider,
              OAuthTokenProvider, appConfigProvider) {

        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;
        $httpProvider.interceptors.splice(0,1);
        $httpProvider.interceptors.splice(0,1);
        $httpProvider.interceptors.push('oauthFixInterceptor');

        $routeProvider
        .when('/login', {
            templateUrl: 'build/views/login.html',
            controller: "LoginController"
        })
        .when('/logout', {
            resolve: {
                logout: ['$location', 'OAuthToken', function($location, OAuthToken){
                    OAuthToken.removeToken();
                    return $location.path('/login');
                }]
            }
        })
        .when('/home', {
            templateUrl: "build/views/home.html",
            controller: "HomeController"
        })
        .when('/orions/dashboard', {
            templateUrl: "build/views/orion/dashboard.html",
            controller: "OrionDashboardController",
            title: "Fiware Orion Context Broker"
        })

        .when('/orions', {
            templateUrl: "build/views/orion/list.html",
            controller: "OrionListController",
            title: "Fiware Orion Context Broker"
        })
        .when('/orions/new', {
            templateUrl: "build/views/orion/new.html",
            controller: "OrionNewController",
            title: "Fiware Orion Context Broker"
        })
        .when('/orions/:id/edit', {
            templateUrl: "build/views/orion/edit.html",
            controller: "OrionEditController",
            title: "Fiware Orion Context Broker"
        })
        .when('/orions/:id/remove', {
            templateUrl: "build/views/orion/remove.html",
            controller: "OrionRemoveController",
            title: "Fiware Orion Context Broker"
        })
        .when('/idas', {
            templateUrl: "build/views/idas/list.html",
            controller: "IdasListController",
            title: "Fiware Backend Device Management"
        })
        .when('/idas/new', {
            templateUrl: "build/views/idas/new.html",
            controller: "IdasNewController",
            title: "Fiware Backend Device Management"
        })
        .when('/idas/:id/edit', {
            templateUrl: "build/views/idas/edit.html",
            controller: "IdasEditController",
            title: "Fiware Backend Device Management"
        })
        .when('/idas/:id/remove', {
            templateUrl: "build/views/idas/remove.html",
            controller: "IdasRemoveController",
            title: "Fiware Backend Device Management"
        })
        .when('/iotenvs/dashboard', {
            templateUrl: "build/views/iotenv/dashboard.html",
            controller: "IotEnvDashboardController",
            title: "IoT Environments"
        })
        .when('/iotenvs', {
            templateUrl: "build/views/iotenv/list.html",
            controller: "IotEnvListController",
            title: "IoT Environments"
        })
        .when('/iotenvs/new', {
            templateUrl: "build/views/iotenv/new.html",
            controller: "IotEnvNewController",
            title: "IoT Environments"
        })
        .when('/iotenvs/:id/edit', {
            templateUrl: "build/views/iotenv/edit.html",
            controller: "IotEnvEditController",
            title: "IoT Environments"
        })
        .when('/iotenvs/:id/remove', {
            templateUrl: "build/views/iotenv/remove.html",
            controller: "IotEnvRemoveController",
            title: "IoT Environments"
         })
        .when('/iotenv/:id/devicemodels', {
            templateUrl: "build/views/iotenv-devicemodel/list.html",
            controller: "DeviceModelListController",
            title: "IoT Environment Device Model"
        })
        .when('/iotenv/:id/devicemodels/:idDeviceModel/show', {
            templateUrl: "build/views/iotenv-devicemodel/show.html",
            controller: "DeviceModelShowController",
            title: "IoT Environment Device Model"
        })
        .when('/iotenv/:id/devicemodels/new', {
            templateUrl: "build/views/iotenv-devicemodel/new.html",
            controller: "DeviceModelNewController",
            title: "IoT Environment Device Model"
        })
        .when('/iotenv/:id/devicemodels/:idDeviceModel/edit', {
            templateUrl: "build/views/iotenv-devicemodel/edit.html",
            controller: "DeviceModelEditController",
            title: "IoT Environment Device Model"
        })
        .when('/iotenv/:id/devicemodels/:idDeviceModel/remove', {
            templateUrl: "build/views/iotenv-devicemodel/remove.html",
            controller: "DeviceModelRemoveController",
            title: "IoT Environment Device Model"
        })
        .when('/iotenv/:id/iotenvmembers/', {
            templateUrl: "build/views/iotenv-member/list.html",
            controller: "IoTEnvMemberListController",
            title: "IoT Environment Members"
        })
        .when('/iotenv/:id/iotenvmember/:idIotEnvMember/remove', {
            templateUrl: "build/views/iotenv-member/remove.html",
            controller: "IoTEnvMemberRemoveController",
            title: "IoT Environment Members"
        });

    OAuthProvider.configure({
        baseUrl: appConfigProvider.config.baseUrl,
        clientId: 'appid_1',
        clientSecret: 'secret', // optional
        grantPath: 'oauth/access_token'
    });

    //This section must be eliminated when using https.
    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false
        }

    })
}]);

app.run(['$rootScope', '$route', '$location', '$http', '$modal', 'httpBuffer','OAuth', function($rootScope, $route, $location, $http, $modal, httpBuffer, OAuth) {
    $rootScope.$on('$routeChangeStart', function(event, next, current){
        if(next.$$route.originalPath != '/login') {
            if(!OAuth.isAuthenticated()) {
                $location.path('login');
            }
        }
    });

    $rootScope.$on('$routeChangeSuccess', function(event, current, previous){
        $rootScope.pageTitle = current.$$route.title;
    });

    $rootScope.$on('oauth:error', function(event, data) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === data.rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('access_denied' === data.rejection.data.error) {
            httpBuffer.append(data.rejection.config, data.deferred);
            if(!$rootScope.loginModalOpened){
                var modalInstance = $modal.open({
                    templateUrl: 'build/views/templates/loginModal.html',
                    controller: 'LoginModalController'
                });
                $rootScope.loginModalOpened = true;
            }
            return;
        }

        // Redirect to `/login` with the `error_reason`.
        return $location.path('login');
    });
}]);
