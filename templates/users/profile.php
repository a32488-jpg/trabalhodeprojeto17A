<div style="max-width:600px;margin:0 auto">
    <div class="page-header"><h1>Perfil</h1></div>
    <div class="form-card">
        <div style="text-align:center;margin-bottom:1.5rem">
            <?php if (!empty($user->avatar)): ?>
                <img src="<?= $this->Url->build(['controller' => 'Users', 'action' => 'avatar', $user->id]) ?>"
                     style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #e63946;display:block;margin:0 auto .5rem"
                     alt="avatar">
            <?php else: ?>
                <div style="width:100px;height:100px;border-radius:50%;background:#1a1a2e;display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:white;margin:0 auto .5rem">
                    <?= strtoupper(substr($user->username, 0, 1)) ?>
                </div>
            <?php endif; ?>
            <p style="color:#6b7280"><?= h($user->email) ?></p>
        </div>
        <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
            <?= $this->Form->control('username', ['label' => 'Utilizador']) ?>
            <?= $this->Form->control('email',    ['label' => 'Email']) ?>
            <?= $this->Form->control('bio',      ['label' => 'Biografia', 'type' => 'textarea', 'rows' => 4]) ?>
            <div class="input">
                <label>Foto de perfil</label>
                <?= $this->Form->file('avatar_upload', ['accept' => 'image/*']) ?>
                <small style="color:#6b7280">Max: 2MB. Formatos: JPG, PNG, GIF, WEBP</small>
            </div>
            <div class="input">
                <label>Nova palavra-passe <small style="color:#6b7280">(deixe vazio para manter)</small></label>
                <?= $this->Form->password('password', ['placeholder' => '...']) ?>
            </div>
            <div style="display:flex;gap:1rem;margin-top:1rem;align-items:center">
                <?= $this->Form->button('Atualizar') ?>
                <?= $this->Html->link('Cancelar', ['controller' => 'Articles', 'action' => 'index'], ['class' => 'back-link']) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
    <?php if (!empty($user->bio)): ?>
        <div class="form-card" style="margin-top:1rem">
            <h3 style="margin-bottom:.8rem">Sobre mim</h3>
            <p><?= nl2br(h($user->bio)) ?></p>
        </div>
    <?php endif; ?>
</div>