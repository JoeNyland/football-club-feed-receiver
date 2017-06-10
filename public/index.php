<?php

// This is the main entry point for the app

// ToDo: Log what the app is doing using a logger like Monolog
// ToDo: Setup a filter to only allow data to be posted using an authorised key
// ToDo: Add more input validation at the model layer

require __DIR__ . '/../lib/autoload.php';
require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

// Define a route where feed data will be submitted to the app from the 3rd party aggregator
$router->post('/feed/submit', ['\Controller\FeedEvents', 'process']);

// Setup a dispatcher
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
try {
    // Try and dispatch the request and catch exceptions from PHRoute
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    // No route handler found for the requested URI, so return a 404 HTTP code and render the 404 page
    http_response_code(404);
    error_log($e->getMessage());
    $response = 'The requested resource was not found';
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    // No route handler for the requested HTTP method, so return a 405 HTTP code and render the 405 page
    http_response_code(405);
    error_log($e->getMessage());
    $response = 'The requested method is not available on the requested resource';
} catch (Exception $e) {
    // This serves as a catch-all exception handler so that we can return a styled response to users if a server error occurs.
    http_response_code(500);
    error_log($e->getMessage());
    $response = 'Sorry, but an error occurred whilst processing your request';
}

// Print out the value returned from the dispatched function
echo $response . PHP_EOL;
