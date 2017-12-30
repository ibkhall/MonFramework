<?php
namespace App\Blog\Actions;

use App\Blog\Table\PostTable;
use Framework\Actions\RouterAwareAcion;
use Framework\Router;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Renderer\RendererInterface;

class BlogAction
{


    private $renderer;
    /**
     * @var Router
     */
    private $router;
    /**
     * @var PostTable
     */
    private $postTable;

    use RouterAwareAcion;

    public function __construct(RendererInterface $renderer, Router $router, PostTable $postTable)
    {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->postTable = $postTable;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        if ($request->getAttribute('id')) {
            return $this->show($request);
        }

           return $this->index();
    }

    public function index(): string
    {
        $posts = $this->postTable->findPaginated();

        return $this->renderer->render('@blog/index', compact('posts'));
    }

    public function show(ServerRequestInterface $request)
    {
        $slug = $request->getAttribute('slug');
        $post = $this->postTable->find($request->getAttribute('id'));
        if ($post->slug !== $slug) {
            return $this->redirect('blog.show', [
                'slug' => $post->slug,
                'id' => $post->id
            ]);
        }

        return $this->renderer->render('@blog/show', [
            'post' => $post
        ]);
    }
}
