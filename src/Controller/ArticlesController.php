<?php
declare(strict_types=1);
namespace App\Controller;

class ArticlesController extends AppController
{
    protected array $paginate = [
        'limit' => 5,
        'order' => ['Articles.created' => 'DESC'],
    ];

    public function index()
    {
        $query = $this->Articles->find()
            ->contain(['Users', 'Categories'])
            ->orderBy(['Articles.created' => 'DESC']);

        $articles = $this->paginate($query);
        $this->set(compact('articles'));
        $this->set('loggedIn', $this->isLoggedIn());
    }

    public function view($id)
    {
        $article = $this->Articles->get($id, contain: ['Users', 'Categories', 'Comments']);
        $comment = $this->Articles->Comments->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['article_id'] = $id;
            $comment = $this->Articles->Comments->patchEntity($comment, $data);
            if ($this->Articles->Comments->save($comment)) {
                $this->Flash->success('Comentario publicado!');
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error('Verifique os campos.');
        }

        $this->set('loggedIn', $this->isLoggedIn());
        $this->set(compact('article', 'comment'));
    }

    public function add()
    {
        $this->requireLogin();
        $article = $this->Articles->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Guardar imagem na base de dados como BLOB
            $imageFile = $this->request->getUploadedFile('image_upload');
            if ($imageFile && $imageFile->getError() === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($imageFile->getClientFilename(), PATHINFO_EXTENSION));
                $allowed = ['jpg','jpeg','png','gif','webp'];
                if (in_array($ext, $allowed)) {
                    $data['image']      = $imageFile->getStream()->getContents();
                    $data['image_type'] = $imageFile->getClientMediaType();
                }
            }

            // Garantir que category_id e user_id estao presentes
            $user = $this->request->getSession()->read('Auth.User');
            $data['user_id'] = $user['id'];

            $article = $this->Articles->patchEntity($article, $data);

            if ($this->Articles->save($article)) {
                $this->Flash->success('Artigo publicado!');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Nao foi possivel publicar. Verifique todos os campos.');
        }

        $categories = $this->Articles->Categories->find('list')->orderBy(['name' => 'ASC']);
        $this->set(compact('article', 'categories'));
    }

    public function edit($id)
    {
        $this->requireLogin();
        $article = $this->Articles->get($id);
        $user = $this->request->getSession()->read('Auth.User');
        
        // Verificar se o usuário é o dono do artigo
        if ($article->user_id !== $user['id']) {
            throw new \Cake\Http\Exception\ForbiddenException('Você não pode editar este artigo.');
        }

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            // Guardar nova imagem na BD se foi enviada
            $imageFile = $this->request->getUploadedFile('image_upload');
            if ($imageFile && $imageFile->getError() === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($imageFile->getClientFilename(), PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
                    $data['image']      = $imageFile->getStream()->getContents();
                    $data['image_type'] = $imageFile->getClientMediaType();
                }
            }

            $article = $this->Articles->patchEntity($article, $data);
            if ($this->Articles->save($article)) {
                $this->Flash->success('Artigo atualizado!');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Nao foi possivel atualizar.');
        }

        $categories = $this->Articles->Categories->find('list')->orderBy(['name' => 'ASC']);
        $this->set(compact('article', 'categories'));
    }

    public function delete($id)
    {
        $this->requireLogin();
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        $user = $this->request->getSession()->read('Auth.User');
        
        // Verificar se o usuário é o dono do artigo
        if ($article->user_id !== $user['id']) {
            throw new \Cake\Http\Exception\ForbiddenException('Você não pode deletar este artigo.');
        }

        if ($this->Articles->delete($article)) {
            $this->Flash->success('Artigo eliminado!');
        } else {
            $this->Flash->error('Nao foi possivel eliminar.');
        }
        return $this->redirect(['action' => 'index']);
    }

    // Serve a imagem do artigo diretamente da BD
    public function image($id)
    {
        $article = $this->Articles->get($id);
        if (empty($article->image)) {
            throw new \Cake\Http\Exception\NotFoundException();
        }
        $response = $this->response
            ->withType($article->image_type ?? 'image/jpeg')
            ->withStringBody($article->image);
        return $response;
    }

    public function search()
    {
        $keyword = trim((string)$this->request->getQuery('q', ''));
        $articles = [];

        if ($keyword !== '') {
            $query = $this->Articles->find()
                ->contain(['Users', 'Categories'])
                ->where([
                    'OR' => [
                        'Articles.title LIKE' => '%' . $keyword . '%',
                        'Articles.body LIKE'  => '%' . $keyword . '%',
                    ],
                ])
                ->orderBy(['Articles.created' => 'DESC']);
            $articles = $this->paginate($query);
        }

        $this->set('loggedIn', $this->isLoggedIn());
        $this->set(compact('articles', 'keyword'));
    }
}