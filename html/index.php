<?php
 
require_once __DIR__.'/../vendor/autoload.php';
//require_once __DIR__.'/../src/menu_config.php';

session_start();

use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpKernel\HttpCache\Store;

//Error & Exception Handling 
//\set_exception_handler("\\Error\\Model\\ExceptionHandler::logException");

/*
\set_error_handler("\\Error\\Model\\ExceptionHandler::logError");
\register_shutdown_function("\\Error\\Model\\ExceptionHandler::checkForFatal");
 */

$request = Request::createFromGlobals();

$routes = include __DIR__.'/../src/routes.php';
$sc = include __DIR__.'/../src/container.php';

$response = $sc->get('framework')->handle($request);
$response->send();
//For caching
//$framework = new HttpCache($framework, new Store(__DIR__.'/cache'));
//Doing caching via smarty templates
