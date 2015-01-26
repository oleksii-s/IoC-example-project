<?php
namespace Project;

require __DIR__ . './../vendor/autoload.php';

error_reporting(E_ALL);

$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse();

foreach ($response->getHeaders() as $header) {
	header($header);
}
$routeDefinitionCallback = function(\FastRoute\RouteCollector $rC) {
 	$routes = include('Routes.php');
	foreach ($routes as $route) {
		$rC->addRoute($route[0], $route[1], $route[2]);
	}
};
$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

switch ($routeInfo[0]) {
	case \FastRoute\Dispatcher::NOT_FOUND:
		 $response->setContent('404 not found');
		 $response->setStatusCode(404);
		break;

	case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		$response->setContent('405 method not allowed');
		$response->setStatusCode(405);
		break;

	case \FastRoute\Dispatcher::FOUND:
		$className = $routeInfo[1][0];
		$method = $routeInfo[1][1];
		$vars = $routeInfo[2];

		$class = new $className;
		$class->$method($vars);
		break;
}

echo $response->getContent();
