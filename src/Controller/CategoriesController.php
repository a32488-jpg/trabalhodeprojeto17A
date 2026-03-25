<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;

class CategoriesController extends AppController
{
    public function index()
    {
        $categories = $this->Categories->find()->orderBy(['name' => 'ASC']);
        $this->set(compact('categories'));
    }

    public function add()
    {
        $this->requireLogin();
        $category = $this->Categories->newEmptyEntity();

        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success('Categoria criada!');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Nao foi possivel criar.');
        }
        $this->set(compact('category'));
    }

    public function edit($id)
    {
        $this->requireLogin();
        $category = $this->Categories->get($id);

        if ($this->request->is(['post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success('Categoria atualizada!');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Nao foi possivel atualizar.');
        }
        $this->set(compact('category'));
    }

    public function delete($id)
    {
        $this->requireLogin();
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);

        if ($this->Categories->delete($category)) {
            $this->Flash->success('Categoria eliminada!');
        } else {
            $this->Flash->error('Nao foi possivel eliminar.');
        }
        return $this->redirect(['action' => 'index']);
    }
}