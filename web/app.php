<?php

use ScayTrase\Symfony\Sample\Kernel\AppCache;
use ScayTrase\Symfony\Sample\Kernel\AppKernel;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../app/autoload.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
$kernel = new AppCache($kernel);

$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$kernel->terminate($request, $response);
$response->send();
