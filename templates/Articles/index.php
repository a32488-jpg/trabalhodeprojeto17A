<div class="page-header">
    <h1>Artigos</h1>
    <?php if ($loggedIn): ?>
        <?= $this->Html->link('+ Novo Artigo', ['action' => 'add'], ['class' => 'btn']) ?>
    <?php endif; ?>
</div>
<?php if (!$articles->count()): ?>
    <p class="empty">Ainda nao existem artigos publicados.</p>
<?php else: ?>
    <div class="articles-list">
        <?php foreach ($articles as $article): ?>
            <div class="article-card">
                <span class="category-badge"><?= h($article->category->name) ?></span>
                <?php if (!empty($article->image)): ?>
                    <div class="article-card-image">
                        <img src="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'image', $article->id]) ?>"
                             alt="<?= h($article->title) ?>">
                    </div>
                <?php endif; ?>
                <h2><?= $this->Html->link(h($article->title), ['action' => 'view', $article->id]) ?></h2>
                <p class="article-excerpt"><?= h(mb_strimwidth($article->body, 0, 150, '...')) ?></p>
                <div class="article-meta">
                    <span>Por <strong><?= h($article->user->username) ?></strong></span>
                    <span><?= $article->created->format('d/m/Y') ?></span>
                    <?= $this->Html->link('Ler mais &rarr;', ['action' => 'view', $article->id], ['escape' => false]) ?>
                </div>
                <?php if ($loggedIn): ?>
                    <div class="article-actions">
                        <?= $this->Html->link('Editar', ['action' => 'edit', $article->id]) ?>
                        <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $article->id], ['confirm' => 'Tem a certeza?']) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination">
        <?= $this->Paginator->prev('&laquo; Anterior', ['escape' => false]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('Seguinte &raquo;', ['escape' => false]) ?>
        <p class="pagination-info"><?= $this->Paginator->counter('Pagina {{page}} de {{pages}} &middot; {{count}} artigos', ['escape' => false]) ?></p>
    </div>
<?php endif; ?>