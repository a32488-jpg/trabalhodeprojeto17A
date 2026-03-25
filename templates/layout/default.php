<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Online</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
    <?= $this->Html->css('style') ?>
</head>
<body>
<nav>
    <div class="nav-brand">
        <?= $this->Html->link('<span>B</span>log Online', ['controller' => 'Articles', 'action' => 'index'], ['escape' => false]) ?>
    </div>
    <form action="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'search']) ?>" method="get" class="search-form">
        <input type="text" name="q" placeholder="Pesquisar..." value="<?= h($this->request->getQuery('q', '')) ?>">
        <button type="submit">Pesquisar</button>
    </form>
    <div class="nav-links">
        <?= $this->Html->link('Artigos', ['controller' => 'Articles', 'action' => 'index']) ?>
        <?= $this->Html->link('Categorias', ['controller' => 'Categories', 'action' => 'index']) ?>
        <?php $u = $this->request->getSession()->read('Auth.User'); ?>
        <?php if ($u): ?>
            <?= $this->Html->link('+ Novo Artigo', ['controller' => 'Articles', 'action' => 'add']) ?>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>" class="nav-profile">
                <?php if (!empty($u['avatar'])): ?>
                    <img src="<?= $this->Url->build(['controller' => 'Users', 'action' => 'avatar', $u['id']]) ?>"
                         alt="avatar" class="nav-avatar">
                <?php else: ?>
                    <span class="nav-avatar-placeholder"><?= strtoupper(substr($u['username'], 0, 1)) ?></span>
                <?php endif; ?>
                <?= h($u['username']) ?>
            </a>
            <?= $this->Html->link('Sair', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-logout']) ?>
        <?php else: ?>
            <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-login']) ?>
            <?= $this->Html->link('Registar', ['controller' => 'Users', 'action' => 'register'], ['class' => 'nav-register']) ?>
        <?php endif; ?>
    </div>
</nav>
<div class="container">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<footer>
    <p>Blog Online &copy; <?= date('Y') ?> &middot; CakePHP 5 &middot; PSI 12</p>
</footer>
</body>
</html>