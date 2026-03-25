<?php
declare(strict_types=1);
namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected array $_accessible = [
        'username'    => true,
        'email'       => true,
        'password'    => true,
        'bio'         => true,
        'avatar'      => true,
        'avatar_type' => true,
        '*'           => false,
    ];

    protected array $_hidden = ['password'];

    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return password_hash($password, PASSWORD_BCRYPT);
        }
        return null;
    }
}