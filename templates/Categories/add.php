<div style="max-width:500px;margin:0 auto">
    <div class="page-header"><h1>Nova Categoria</h1></div>
    <div class="form-card">
        <?= $this->Form->create($category) ?>
            <?= $this->Form->control('name', ['label' => 'Nome']) ?>
            <div style="display:flex;gap:1rem;margin-top:1rem;align-items:center">
                <?= $this->Form->button('Criar') ?>
                <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'back-link']) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>