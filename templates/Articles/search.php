<!-- ============================================================
     templates/Articles/search.php — pesquisa corrigida
     ============================================================ -->
<div class="page-header">
    <h1><?= __('Search') ?>: "<?= h($keyword) ?>"</h1>
</div>

<?php if (empty($keyword)): ?>
    <p>Introduza uma palavra-chave para pesquisar.</p>

<?php elseif (empty($articles) || $articles->count() === 0): ?>
    <p style="color:#6b7280;">Nenhum artigo encontrado para "<strong><?= h($keyword) ?></strong>".</p>

<?php else: ?>
    <p style="color:#6b7280; margin-bottom:1.5rem;">
        <?= $articles->count() ?> artigo(s) encontrado(s).
    </p>

    <div class="articles-list">
        <?php foreach ($articles as $article): ?>
            <div class="article-card">
                <span class="category-badge"><?= h($article->category->name) ?></span>
                <h2><?= $this->Html->link(h($article->title), ['controller' => 'Articles', 'action' => 'view', $article->id]) ?></h2>
                <p class="article-excerpt"><?= h(mb_strimwidth($article->body, 0, 150, '...')) ?></p>
                <div class="article-meta">
                    <span>Por <strong><?= h($article->user->username) ?></strong></span>
                    <span><?= $article->created->format('d/m/Y') ?></span>
                    <?= $this->Html->link('Ler mais →', ['controller' => 'Articles', 'action' => 'view', $article->id]) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?= $this->Paginator->prev('← Anterior') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('Seguinte →') ?>
    </div>
<?php endif; ?>

<?= $this->Html->link('← ' . __('Back'), ['controller' => 'Articles', 'action' => 'index'], ['class' => 'back-link']) ?>