<!-- ============================================================
     templates/Users/login.php
     VIEW - Formulário de Login
     ============================================================ -->
<div class="form-page">
    <h1>🔑 Login</h1>

    <!-- $this->Form->create() gera automaticamente o token CSRF -->
    <?= $this->Form->create() ?>
        <?= $this->Form->control('username', [
            'label'       => 'Nome de utilizador',
            'placeholder' => 'O seu username...',
        ]) ?>
        <?= $this->Form->control('password', [
            'label'       => 'Palavra-passe',
            'type'        => 'password',
            'placeholder' => '••••••',
        ]) ?>
        <?= $this->Form->button('Entrar') ?>
    <?= $this->Form->end() ?>

    <p>Não tem conta? <?= $this->Html->link('📝 Registar', ['action' => 'register']) ?></p>
    <p><?= $this->Html->link('← Ver artigos', ['controller' => 'Articles', 'action' => 'index']) ?></p>
</div>