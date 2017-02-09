var app = angular.module('app',['ngRoute', 'angular-oauth2','app.controllers', 'app.services']);

angular.module('app.controllers',['ngMessages','angular-oauth2']);
angular.module('app.services',['ngResource']);

app.provider('appConfig', function () {
    var config = {
        baseUrl: "http://localhost:8000"
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
    function ($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {

        $httpProvider.defaults.transformResponse = function (data, headers) {
            var headersGetter = headers();
            if(headersGetter['content-type'] == 'application/json' ||
                headersGetter['content-type'] == 'text/json') {

                var dataJson = JSON.parse(data);
                if(dataJson.hasOwnProperty('data')){
                    dataJson = dataJson.data;
                }
                return dataJson;

            }
            return data;
        };
        $routeProvider
        .when('/login', {
            templateUrl: 'build/views/login.html',
            controller: "LoginController"
        })
        .when('/home', {
            templateUrl: "build/views/home.html",
            controller: "HomeController"
        })
        .when('/orions', {
            templateUrl: "build/views/orion/list.html",
            controller: "OrionListController"
        })
        .when('/orions/new', {
            templateUrl: "build/views/orion/new.html",
            controller: "OrionNewController"
        })
        .when('/orions/:id/edit', {
            templateUrl: "build/views/orion/edit.html",
            controller: "OrionEditController"
        })
        .when('/orions/:id/remove', {
            templateUrl: "build/views/orion/remove.html",
            controller: "OrionRemoveController"
        })
        .when('/idas', {
            templateUrl: "build/views/idas/list.html",
            controller: "IdasListController"
        })
        .when('/idas/new', {
            templateUrl: "build/views/idas/new.html",
            controller: "IdasNewController"
        })
        .when('/idas/:id/edit', {
            templateUrl: "build/views/idas/edit.html",
            controller: "IdasEditController"
        })
        .when('/idas/:id/remove', {
            templateUrl: "build/views/idas/remove.html",
            controller: "IdasRemoveController"
        });

    OAuthProvider.configure({
        baseUrl: appConfigProvider.config.baseUrl,
        clientId: 'appid_1',
        clientSecret: 'secret', // optional
        grantPath: 'oauth/access_token'
    });

    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false
        }

    })
}]);

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function(event, rejection) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('invalid_token' === rejection.data.error) {
            return OAuth.getRefreshToken();
        }

        // Redirect to `/login` with the `error_reason`.
        return $window.location.href = '/login?error_reason=' + rejection.data.error;
    });
}]);
