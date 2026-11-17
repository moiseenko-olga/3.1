<?php

class ArticlesController
{
    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/templates');
        $this->db = new Db();
    }

    public function show(int $articleId)
    {
        // 1. Получаем статью из таблицы articles
        $result = $this->db->query(
            'SELECT * FROM articles WHERE id = :id;',
            [':id' => $articleId]
        );

        if (empty($result)) {
            http_response_code(404);
            echo 'Статья не найдена!';
            return;
        }

                $article = $result[0];

        // 2. Второй запрос: получаем автора этой статьи из таблицы users
        $authorResult = $this->db->query(
            'SELECT * FROM users WHERE id = :id;',
            [':id' => $article['author_id']]
        );
        $author = $authorResult[0] ?? ['nickname' => 'Неизвестный автор'];

        // 3. Передаём статью и автора в шаблон
        $this->view->renderHtml('articles/show.php', [
            'article' => $article,
            'author'  => $author,
            'title'   => $article['name']
        ]);
    }
}
