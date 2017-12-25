<?php

namespace Tests\Framework;


use Framework\Renderer;

class RendererTest extends \PHPUnit\Framework\TestCase {

    private $renderer;

    public function setUp(){
        $this->renderer = new Renderer();
        $this->renderer->addPath(__DIR__. '/views');
    }

    public function testRendererTheRightPath() {

        $this->renderer->addPath('blog', __DIR__. '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('salut les gens', $content);
    }

    public function testRendererTheDefaultPath() {

        $content = $this->renderer->render('demo');
        $this->assertEquals('salut les gens', $content);
    }

    public function testRendererWithParams() {

        $content = $this->renderer->render('demoparams', ['nom' => 'Marc']);
        $this->assertEquals('salut Marc', $content);
    }

    public function testGlobalParameters() {
        $this->renderer->addGlobal('nom', 'Marc');
        $content = $this->renderer->render('demoparams');
        $this->assertEquals('salut Marc', $content);
    }
}