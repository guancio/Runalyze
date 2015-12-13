<?php
// web/app.php
use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__.'/../config/autoload.php';
require_once __DIR__.'/../MicroKernel.php';

$app = new MicroKernel('prod', false);
$app->loadClassCache();

$app->handle(Request::createFromGlobals())->send();
