<?php

use Wouterds\Application\Http\Handlers\Admin\AdminSignUpHandler;
use Wouterds\Application\Http\Handlers\HomeHandler;
use Wouterds\Application\Http\Middlewares\TwigMiddleware;

$app->group(null, function () use ($app) {

    $app->get('/', HomeHandler::class)->setName('home');
    $app->group('/admin', function () use ($app) {
        $app->get('/sign-up', AdminSignUpHandler::class)->setName('admin.sign-up');
    });

})->add(TwigMiddleware::class);