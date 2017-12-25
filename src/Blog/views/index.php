<?= $renderer->render('header'); ?>

<h1>Bienvenue sur le blog</h1>

<ul>
    <li><a href="<?= $router->generateUri('blog.show', ['slug' => 'zerzeaaza-9azaz']); ?>">Article1</a></li>
    <li>Article2</li>
    <li>Article3</li>
    <li>Article4</li>
</ul>

<?= $renderer->render('footer'); ?>
