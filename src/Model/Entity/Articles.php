<?php
declare(strict_types=1);
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    // Todos os campos que podem ser preenchidos via formulario
    protected array $_accessible = [
        'user_id'     => true,
        'category_id' => true,
        'title'       => true,
        'body'        => true,
        'image'       => true,
        'image_type'  => true,
        '*'           => false,
    ];
}