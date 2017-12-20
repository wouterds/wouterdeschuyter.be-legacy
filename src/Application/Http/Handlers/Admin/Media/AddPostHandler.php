<?php

namespace WouterDeSchuyter\Application\Http\Handlers\Admin\Media;

use League\Tactician\CommandBus;
use Psr\Http\Message\UploadedFileInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use WouterDeSchuyter\Domain\Commands\Media\AddMedia;

class AddPostHandler
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $this->commandBus->handle(new AddMedia(
            $request->getParam('label'),
            $request->getUploadedFiles()['file']
        ));

        return $response->withJson(true);
    }
}