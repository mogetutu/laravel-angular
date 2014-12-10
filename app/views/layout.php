<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" ng-app="todo-app"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laravel Angular</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.css"/>

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
</head>
<body>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->
<div class="container">
	<div class="col-md-6 col-md-offset-3">
		<div class="row" ng-controller="TodoCtrl">
			<div class="page-header">
				<h2>
					Todos
					<small ng-if="remaining()">({{ remaining() }} remaining)</small>
				</h2>
			</div>
			<div class="form-group">
				<input type="text" placeholder="Search Todos" class="form-control" ng-model="search">
			</div>
			<ul class="list-group">
				<li class="list-group-item" ng-repeat="todo in todos | filter:search">
					<input type="checkbox" ng-model="todo.completed" ng-change="completeTodo(todo)">
					&nbsp;
					{{ todo.title }}
					<a class="pull-right label label-danger" ng-click="deleteTodo(todo)">remove</a>
				</li>
			</ul>
			<form ng-submit="addTodo()" class="form-inline">
				<div class="form-group">
					<input type="text" placeholder="add new todo" class="form-control" ng-model="newTodoText">
				</div>
				<div class="form-group">
					<input type="submit" value="Add Task" class="btn btn-default">
				</div>
			</form>
		</div>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular.min.js"></script>
<script src="/js/app.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-53797172-1', 'auto');
	ga('send', 'pageview');
</script>
</body>
</html>