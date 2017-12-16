<?php

use WouterDeSchuyter\Application\Http\Handlers\AboutHandler;
use WouterDeSchuyter\Application\Http\Handlers\Admin\OverviewHandler as AdminOverviewHandler;
use WouterDeSchuyter\Application\Http\Handlers\Admin\SignInHandler as AdminSignInHandler;
use WouterDeSchuyter\Application\Http\Handlers\BlogHandler;
use WouterDeSchuyter\Application\Http\Handlers\ContactHandler;
use WouterDeSchuyter\Application\Http\Handlers\ContactPostHandler;
use WouterDeSchuyter\Application\Http\Handlers\HomeHandler;
use WouterDeSchuyter\Application\Http\Middlewares\Admin\AuthenticatedUserMiddleware as AdminAuthenticatedUserMiddleware;

$app->group(null, function () use ($app) {
    $app->get('/', HomeHandler::class)->setName('home');
    $app->get('/about', AboutHandler::class)->setName('about');
    $app->get('/blog', BlogHandler::class)->setName('blog');
    $app->get('/contact', ContactHandler::class)->setName('contact');
    $app->post('/contact.json', ContactPostHandler::class)->setName('contactPost');

    // Public admin routes
    $app->group('/admin', function () use ($app) {
        $app->get('/sign-in', AdminSignInHandler::class)->setName('admin.sign-in');
    });

    // Private admin routes
    $app->group('/admin', function () use ($app) {
        $app->get('', AdminOverviewHandler::class)->setName('admin.overview');
    })->add(AdminAuthenticatedUserMiddleware::class);
});
