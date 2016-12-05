<?php

use ScayTrase\Symfony\Sample\Kernel\AppKernel;
use Symfony\Component\Console\Input\ArgvInput;

require_once __DIR__.'/../app/autoload.php';

$input = new ArgvInput();

$env   = $input->getParameterOption(['--env', '-e'], getenv('SYMFONY_ENV') ?: 'dev');
$debug = getenv('SYMFONY_DEBUG') !== '0' && !$input->hasParameterOption(['--no-debug', '']) && $env !== 'prod';


$kernel      = new AppKernel($env, $debug);
$application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);

$application->run($input);
