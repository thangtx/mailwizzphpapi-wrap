<?php

require 'vendor/autoload.php';
require_once dirname(__FILE__) . '/setup.php';


$app = new \Slim\Slim();

# fix for setting correct PATH_INFO
$requestPath = parse_url($_SERVER['REQUEST_URI'])['path'];
$env = $app->environment;
$env['PATH_INFO'] = substr($requestPath, 0, strlen($env['SCRIPT_NAME'])) == $env['SCRIPT_NAME']
    ? substr_replace($requestPath, '', 0, strlen($env['SCRIPT_NAME'])) : $requestPath ;
# fix end

$app->notFound(function () use ($app) {
    echo json_encode(array('status' => 'error', 'result' => 'Method not found'));
});

require 'src/Middleware.php';

// Authorize API call with app_key
$app->add(new \APIAuthMiddleware());
// Send proper headers for response
$app->add(new \APIResponseMiddleware());

require 'src/Lists.php';
require 'src/Campaigns.php';
require 'src/Subscribers.php';
require 'src/Template.php';
require 'src/TransactMail.php';

$app->run();

