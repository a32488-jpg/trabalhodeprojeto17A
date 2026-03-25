<!-- ============================================================
     templates/Articles/add.php
     VIEW - Formulário para criar novo artigo
     ============================================================ -->
<div style="max-width:680px; margin:0 auto;">

    <div class="page-header">
        <h1>Novo Artigo</h1>
    </div>

    <div class="form-card">
        <!-- enctype obrigatório para upload de ficheiros -->
        <?= $this->Form->create($article, ['enctype' => 'multipart/form-data']) ?>

            <?= $this->Form->control('title', [
                'label'       => 'Título',
                'placeholder' => 'Escreva o título do artigo...',
            ]) ?>

            <?= $this->Form->control('category_id', [
                'label'   => 'Categoria',
                'options' => $categories,
                'empty'   => '-- Selecione uma categoria --',
            ]) ?>

            <?= $this->Form->control('body', [
                'label'       => 'Conteúdo',
                'rows'        => 10,
                'placeholder' => 'Escreva o conteúdo...',
            ]) ?>

            <!-- Upload de imagem (opcional) -->
            <div class="input">
                <label>Imagem do artigo (opcional)</label>
                <?= $this->Form->file('image_upload', [
                    'accept' => 'image/*',
                ]) ?>
                <small style="color:#6b7280;">Formatos aceites: JPG, PNG, GIF, WEBP</small>
            </div>

            <div style="display:flex; gap:1rem; margin-top:1.5rem; align-items:center;">
                <?= $this->Form->button('Publicar Artigo') ?>
                <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'back-link']) ?>
            </div>

        <?= $this->Form->end() ?>
    </div>
</div>