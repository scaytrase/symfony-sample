<?php

use ScayTrase\Symfony\Sample\Kernel\AppKernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../app/autoload.php';

Debug::enable();
$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();

$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$kernel->terminate($request, $response);
$response->send();
