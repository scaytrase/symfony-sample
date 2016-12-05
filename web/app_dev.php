<?php

use ScayTrase\Symfony\Sample\Kernel\AppKernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../app/autoload.php';

$kernel = new AppKernel('dev', true);
Debug::enable();

$kernel->loadClassCache();

$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$response->send();
