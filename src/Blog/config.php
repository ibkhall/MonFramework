<?php
use App\Blog\BlogModule;

return [
    'blog.prefix' => '/blog',
    BlogModule::class => \DI\object()->constructorParameter('prefix', \DI\get('blog.prefix'))
];
