<?php

namespace WouterDeSchuyter\Application\Http\Handlers;

use Slim\Http\Request;
use Slim\Http\Response;
use WouterDeSchuyter\Domain\Blog\BlogPostRepository;
use WouterDeSchuyter\Infrastructure\View\ViewAwareInterface;
use WouterDeSchuyter\Infrastructure\View\ViewAwareTrait;

class BlogHandler implements ViewAwareInterface
{
    use ViewAwareTrait;

    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @param BlogPostRepository $blogPostRepository
     */
    public function __construct(BlogPostRepository $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'pages/blog.html.twig';
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $blogPosts = $this->blogPostRepository->findAll();

        $data = [];
        $data['blogPosts'] = $blogPosts;

        return $this->render($response, $data);
    }
}
