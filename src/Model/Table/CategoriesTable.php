<?php
declare(strict_types=1);
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoriesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->hasMany('Articles');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator->notEmptyString('name', 'O nome da categoria e obrigatorio.');
        return $validator;
    }
}