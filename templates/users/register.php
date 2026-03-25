<!-- ============================================================
     templates/Users/register.php
     VIEW - Formulário de Registo
     ============================================================ -->
<div class="form-page">
    <h1>📝 Criar Conta</h1>

    <!-- $this->Form->create($user) gera o token CSRF automaticamente -->
    <?= $this->Form->create($user) ?>
        <?= $this->Form->control('username', [
            'label'       => 'Nome de utilizador',
            'placeholder' => 'Escolha um username...',
        ]) ?>
        <?= $this->Form->control('email', [
            'label'       => 'Email',
            'placeholder' => 'o-seu@email.com',
        ]) ?>
        <?= $this->Form->control('password', [
            'label'       => 'Palavra-passe',
            'type'        => 'password',
            'placeholder' => 'Mínimo 6 caracteres',
        ]) ?>
        <?= $this->Form->button('Criar Conta') ?>
    <?= $this->Form->end() ?>

    <p>Já tem conta? <?= $this->Html->link('🔑 Fazer login', ['action' => 'login']) ?></p>
</div>