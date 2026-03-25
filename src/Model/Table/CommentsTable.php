<?php
declare(strict_types=1);
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->belongsTo('Articles');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator->notEmptyString('author', 'O nome e obrigatorio.');
        $validator->notEmptyString('body', 'O comentario nao pode estar vazio.');
        return $validator;
    }
}