<article class="article-full">
    <span class="category-badge"><?= h($article->category->name) ?></span>
    <h1><?= h($article->title) ?></h1>
    <div class="article-meta-full">
        <span>Por <strong><?= h($article->user->username) ?></strong></span>
        <span><?= $article->created->format('d/m/Y') ?></span>
    </div>
    <?php if (!empty($article->image)): ?>
        <div class="article-full-image">
            <img src="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'image', $article->id]) ?>"
                 alt="<?= h($article->title) ?>">
        </div>
    <?php endif; ?>
    <div class="article-body"><?= nl2br(h($article->body)) ?></div>
    <?php if ($loggedIn): ?>
        <div class="article-actions">
            <?= $this->Html->link('Editar', ['action' => 'edit', $article->id]) ?>
            <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $article->id], ['confirm' => 'Tem a certeza?']) ?>
        </div>
    <?php endif; ?>
</article>
<hr>
<section class="comments">
    <h2>Comentarios (<?= count($article->comments) ?>)</h2>
    <?php if (empty($article->comments)): ?>
        <p class="empty">Seja o primeiro a comentar!</p>
    <?php else: ?>
        <?php foreach ($article->comments as $c): ?>
            <div class="comment-card">
                <strong><?= h($c->author) ?></strong>
                <span class="comment-date"><?= $c->created->format('d/m/Y') ?></span>
                <p><?= nl2br(h($c->body)) ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <h3>Deixar um comentario</h3>
    <?= $this->Form->create($comment, ['url' => ['action' => 'view', $article->id]]) ?>
        <?= $this->Form->control('author', ['label' => 'O seu nome', 'placeholder' => 'Nome...']) ?>
        <?= $this->Form->control('body',   ['label' => 'Comentario', 'rows' => 4]) ?>
        <?= $this->Form->button('Publicar') ?>
    <?= $this->Form->end() ?>
</section>
<?= $this->Html->link('&larr; Voltar', ['action' => 'index'], ['escape' => false, 'class' => 'back-link']) ?>