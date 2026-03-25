<div class="article-card">
    <span class="category-badge"><?= h($article->category->name) ?></span>
    <?php if (!empty($article->image)): ?>
        <div class="article-card-image"><img src="/<?= h($article->image) ?>" alt="<?= h($article->title) ?>"></div>
    <?php endif; ?>
    <h2><?= $this->Html->link(h($article->title), ['controller' => 'Articles', 'action' => 'view', $article->id]) ?></h2>
    <p class="article-excerpt"><?= h(mb_strimwidth($article->body, 0, 150, '...')) ?></p>
    <div class="article-meta">
        <span>Por <strong><?= h($article->user->username) ?></strong></span>
        <span><?= $article->created->format('d/m/Y') ?></span>
    </div>
</div>