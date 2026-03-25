<?php
declare(strict_types=1);
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users');
        $this->belongsTo('Categories');
        $this->hasMany('Comments', ['dependent' => true]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator->notEmptyString('title',       'O titulo e obrigatorio.');
        $validator->notEmptyString('body',        'O conteudo e obrigatorio.');
        $validator->notEmptyString('category_id', 'Selecione uma categoria.');
        return $validator;
    }
}