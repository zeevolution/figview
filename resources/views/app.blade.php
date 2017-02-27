<!DOCTYPE html>
<html lang="en" ng-app = "app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	@if(Config::get('app.debug'))
        <link href="{{ asset('build/css/font-awesome.css') }}" rel="stylesheet"/>
        <link href="{{ asset('build/css/flaticon.css') }}" rel="stylesheet"/>
        <link href="{{ asset('build/css/app.css') }}" rel="stylesheet"/>
        <link href="{{ asset('build/css/components.css') }}" rel="stylesheet"/>
		<link href="{{ asset('build/css/login.css') }}" rel="stylesheet"/>
	@else
		<link href="{{ elixir('css/all.css') }}" rel="stylesheet"/>
	@endif

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

    <load-template url="/build/views/templates/menu.html"></load-template>

    <!--<div ng-include="'/build/views/templates/menu.html'"> </div>-->

	<div ng-view>

	</div>

	<!-- Scripts -->
	@if(Config::get('app.debug'))
		<script src="{{ asset('build/js/vendor/jquery.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-route.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-resource.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-animate.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-messages.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/navbar.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/query-string.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}"></script>
        <script src="{{ asset('build/js/vendor/tree-grid-directive.js') }}"></script>
        <script src="{{ asset('build/js/vendor/angular-ui-tree.min.js') }}"></script>
        <script src="{{ asset('build/js/vendor/http-auth-interceptor.js') }}"></script>
        <script src="{{ asset('build/js/vendor/dirPagination.js') }}"></script>


		<script src="{{ asset('build/js/app.js') }}"></script>

		<!-- Controllers -->
		<script src="{{ asset('build/js/controllers/login.js') }}"></script>
        <script src="{{ asset('build/js/controllers/loginModal.js') }}"></script>
		<script src="{{ asset('build/js/controllers/home.js') }}"></script>
        <script src="{{ asset('build/js/controllers/menu.js') }}"></script>

		<script src="{{ asset('build/js/controllers/orion/orionList.js') }}"></script>
		<script src="{{ asset('build/js/controllers/orion/orionNew.js') }}"></script>
		<script src="{{ asset('build/js/controllers/orion/orionEdit.js') }}"></script>
		<script src="{{ asset('build/js/controllers/orion/orionRemove.js') }}"></script>
        <script src="{{ asset('build/js/controllers/orion/orionDashboard.js') }}"></script>

        <script src="{{ asset('build/js/controllers/idas/idasList.js') }}"></script>
        <script src="{{ asset('build/js/controllers/idas/idasNew.js') }}"></script>
        <script src="{{ asset('build/js/controllers/idas/idasEdit.js') }}"></script>
        <script src="{{ asset('build/js/controllers/idas/idasRemove.js') }}"></script>
		<script src="{{ asset('build/js/controllers/idas/idasDashboard.js') }}"></script>


        <script src="{{ asset('build/js/controllers/iotenv/iotEnvList.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv/iotEnvNew.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv/iotEnvEdit.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv/iotEnvRemove.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv/iotEnvDashboard.js') }}"></script>


        <script src="{{ asset('build/js/controllers/iotenv-devicemodel/deviceModelList.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv-devicemodel/deviceModelNew.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv-devicemodel/deviceModelEdit.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv-devicemodel/deviceModelRemove.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv-devicemodel/deviceModelShow.js') }}"></script>

        <script src="{{ asset('build/js/controllers/iotenv-member/iotenvMemberList.js') }}"></script>
        <script src="{{ asset('build/js/controllers/iotenv-member/iotenvMemberRemove.js') }}"></script>

        <!-- Directives -->
        <script src="{{ asset('build/js/directives/loginForm.js') }}"></script>
        <script src="{{ asset('build/js/directives/loadTemplate.js') }}"></script>
        <script src="{{ asset('build/js/directives/menu-activated.js') }}"></script>


		<!-- Services -->
		<script src="{{ asset('build/js/services/orion.js') }}"></script>
		<script src="{{ asset('build/js/services/user.js') }}"></script>
        <script src="{{ asset('build/js/services/idas.js') }}"></script>
        <script src="{{ asset('build/js/services/devicemodel.js') }}"></script>
        <script src="{{ asset('build/js/services/iotenv.js') }}"></script>
        <script src="{{ asset('build/js/services/iotenvMember.js') }}"></script>
        <script src="{{ asset('build/js/services/contextTreePath.js') }}"></script>
        <script src="{{ asset('build/js/services/oauthFixInterceptor.js') }}"></script>

	@else
		<script src="{{ elixir('js/all.js') }}"></script>
	@endif
</body>
</html>
