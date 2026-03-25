<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    public function isLoggedIn(): bool
    {
        return (bool) $this->request->getSession()->read('Auth.User');
    }

    public function requireLogin(): void
    {
        if (!$this->isLoggedIn()) {
            $this->Flash->error('Precisa de fazer login.');
            $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
}