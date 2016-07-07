<!DOCTYPE html>
<html ng-app="failboxStore">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="http://paratodohayfans.com/web/failbox/">
	<title>FailBox - Lo que cuenta es de adentro.</title>
	<link rel="shortcut icon" type="image/png" href="./src/images/favicon.png">
	<link rel="stylesheet" type="text/css" href="./css/home.css">
	<link rel="stylesheet" type="text/css" href="./css/home_responsive.css">
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="contenedor">
		<top-menu></top-menu>
		<div class="loadedView" ng-view>
		</div>
		<bottom-site></bottom-site>
		<show-modal-video></show-modal-video>
	</div>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="./js/lib/underscore-min.js"></script>
	<script src="./js/lib/angular.min.js"></script>
  <script src="./js/lib/angular-route.min.js"></script>
  <script src="./js/app.js"></script>
  <script src="./js/controllers.js"></script>
  <script src="./js/directives.js"></script>
	<script src="./js/services.js"></script>
	<script src="./js/filters.js"></script>
</body>
</html>
