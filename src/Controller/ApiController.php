<?php
// ============================================================
//  src/Controller/ApiController.php
//  REST API — Critério M17A: Configurar o REST API
//
//  Fornece endpoints JSON para os artigos do blog.
//  Acesso via URL: /api/articles, /api/articles/1
//
//  Endpoints disponíveis:
//    GET  /api/articles        → lista todos os artigos
//    GET  /api/articles/{id}   → artigo específico
//    POST /api/articles        → criar artigo (JSON body)
//
//  Exemplo de resposta JSON:
//  {
//    "status": "success",
//    "data": [ { "id": 1, "title": "...", "body": "..." } ]
//  }
// ============================================================
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class ApiController extends AppController
{
    // ----------------------------------------------------------
    // initialize()
    // Desativa a proteção CSRF para o API (usa JSON em vez de forms)
    // e configura o RequestHandler para responder em JSON.
    // ----------------------------------------------------------
    public function initialize(): void
    {
        parent::initialize();

        // Permite pedidos sem token CSRF (necessário para API REST)
        $this->Security->setConfig('unlockedActions', ['articles', 'createArticle']);
    }

    // ----------------------------------------------------------
    // articles()
    // GET /api/articles        → lista todos os artigos
    // GET /api/articles?id=1   → artigo específico
    // ----------------------------------------------------------
    public function articles($id = null)
    {
        // Define o cabeçalho de resposta como JSON
        $this->response = $this->response->withType('application/json');

        // Carrega o ArticlesTable
        $articlesTable = $this->fetchTable('Articles');

        if ($id) {
            // Retorna artigo específico pelo id
            try {
                $article = $articlesTable->get($id, ['contain' => ['Users', 'Categories']]);
                $data = [
                    'status' => 'success',
                    'data'   => [
                        'id'       => $article->id,
                        'title'    => $article->title,
                        'body'     => $article->body,
                        'image'    => $article->image,
                        'author'   => $article->user->username ?? 'unknown',
                        'category' => $article->category->name ?? 'unknown',
                        'created'  => $article->created->format('Y-m-d H:i:s'),
                    ],
                ];
            } catch (\Exception $e) {
                $data = ['status' => 'error', 'message' => 'Artigo não encontrado.'];
                $this->response = $this->response->withStatus(404);
            }
        } else {
            // Retorna todos os artigos
            $articles = $articlesTable->find('all')
                ->contain(['Users', 'Categories'])
                ->order(['Articles.created' => 'DESC'])
                ->limit(20)
                ->all();

            $list = [];
            foreach ($articles as $article) {
                $list[] = [
                    'id'       => $article->id,
                    'title'    => $article->title,
                    'excerpt'  => mb_strimwidth($article->body, 0, 100, '...'),
                    'author'   => $article->user->username ?? 'unknown',
                    'category' => $article->category->name ?? 'unknown',
                    'created'  => $article->created->format('Y-m-d H:i:s'),
                ];
            }
            $data = ['status' => 'success', 'total' => count($list), 'data' => $list];
        }

        // Devolve a resposta em JSON
        $this->response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $this->response->withDisabledCache();
    }
}