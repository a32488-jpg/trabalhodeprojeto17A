<?php
declare(strict_types=1);
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->setDisplayField('username');
        $this->hasMany('Articles');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('username', 'O nome de utilizador e obrigatorio.')
            ->minLength('username', 3, 'Minimo 3 caracteres.');
        $validator
            ->notEmptyString('email', 'O email e obrigatorio.')
            ->email('email', false, 'Email invalido.');
        $validator
            ->notEmptyString('password', 'A palavra-passe e obrigatoria.')
            ->minLength('password', 6, 'Minimo 6 caracteres.');
        return $validator;
    }
}