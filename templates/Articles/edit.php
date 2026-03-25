<!-- ============================================================
     templates/Articles/edit.php
     VIEW - Formulário para editar artigo existente
     ============================================================ -->
<div style="max-width:680px; margin:0 auto;">

    <div class="page-header">
        <h1>Editar Artigo</h1>
    </div>

    <div class="form-card">
        <?= $this->Form->create($article, ['enctype' => 'multipart/form-data']) ?>

            <?= $this->Form->control('title', ['label' => 'Título']) ?>

            <?= $this->Form->control('category_id', [
                'label'   => 'Categoria',
                'options' => $categories,
                'empty'   => '-- Selecione uma categoria --',
            ]) ?>

            <?= $this->Form->control('body', [
                'label' => 'Conteúdo',
                'rows'  => 10,
            ]) ?>

            <!-- Imagem atual (se existir) -->
            <?php if (!empty($article->image)): ?>
                <div class="input">
                    <label>Imagem atual:</label>
                    <img src="/cakephp/Trabalho_ProjetoM13_HerikBraga/<?= h($article->image) ?>"
                         alt="imagem atual"
                         style="max-width:200px; border-radius:8px; margin:0.5rem 0; display:block;">
                </div>
            <?php endif; ?>

            <!-- Upload de nova imagem (opcional) -->
            <div class="input">
                <label>Substituir imagem (opcional)</label>
                <?= $this->Form->file('image_upload', ['accept' => 'image/*']) ?>
            </div>

            <div style="display:flex; gap:1rem; margin-top:1.5rem; align-items:center;">
                <?= $this->Form->button('Guardar Alterações') ?>
                <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'back-link']) ?>
            </div>

        <?= $this->Form->end() ?>
    </div>
</div>