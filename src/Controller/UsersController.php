<?php
declare(strict_types=1);
namespace App\Controller;

class UsersController extends AppController
{
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);

        if ($this->request->is('post')) {
            $username = (string)$this->request->getData('username');
            $password = (string)$this->request->getData('password');
            $user = $this->Users->findByUsername($username)->first();

            if ($user && password_verify($password, $user->password)) {
                $this->request->getSession()->write('Auth.User', [
                    'id'       => $user->id,
                    'username' => $user->username,
                    'email'    => $user->email,
                    'avatar'   => !empty($user->avatar),
                ]);
                $this->Flash->success('Bem-vindo, ' . $user->username . '!');
                return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
            }
            $this->Flash->error('Utilizador ou palavra-passe incorretos.');
        }
    }

    public function logout()
    {
        $this->request->getSession()->delete('Auth.User');
        $this->Flash->success('Sessao terminada.');
        return $this->redirect(['action' => 'login']);
    }

    public function register()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('Conta criada! Faca login.');
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('Nao foi possivel criar a conta. Verifique os dados.');
        }
        $this->set(compact('user'));
    }

    // Serve o avatar do utilizador diretamente da BD
    public function avatar(int $id)
    {
        $user = $this->Users->get($id);
        if (empty($user->avatar)) {
            throw new \Cake\Http\Exception\NotFoundException();
        }
        $response = $this->response
            ->withType($user->avatar_type ?? 'image/jpeg')
            ->withStringBody($user->avatar);
        return $response;
    }

    public function profile()
    {
        $this->requireLogin();
        $sessionUser = $this->request->getSession()->read('Auth.User');
        $user = $this->Users->get($sessionUser['id']);

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            // Guardar avatar na BD como BLOB
            $avatarFile = $this->request->getUploadedFile('avatar_upload');
            if ($avatarFile && $avatarFile->getError() === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($avatarFile->getClientFilename(), PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
                    $data['avatar']      = $avatarFile->getStream()->getContents();
                    $data['avatar_type'] = $avatarFile->getClientMediaType();
                }
            }

            if (empty($data['password'])) {
                unset($data['password']);
            }

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                // Atualiza sessao com dados do perfil
                $this->request->getSession()->write('Auth.User', [
                    'id'       => $user->id,
                    'username' => $user->username,
                    'email'    => $user->email,
                    'avatar'   => !empty($user->avatar),
                ]);
                $this->Flash->success('Perfil atualizado!');
                return $this->redirect(['action' => 'profile']);
            }
            $this->Flash->error('Nao foi possivel atualizar.');
        }
        $this->set(compact('user'));
    }
}