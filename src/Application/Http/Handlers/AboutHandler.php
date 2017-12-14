<?php

namespace WouterDeSchuyter\Application\Http\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WouterDeSchuyter\Infrastructure\View\AbstractViewHandler;

class AboutHandler extends AbstractViewHandler
{
    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'pages/about.html.twig';
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $birthday = strtotime('1992-12-13');
        $age = date('Y') - date('Y', $birthday);

        $data = [
            'birthday' => $birthday,
            'age' => $age,
        ];

        return $this->render($response, $data);
    }
}