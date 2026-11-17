<?php

class Db
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $this->initTables();
    }

    public function query(string $sql, array $params = []): array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if ($result === false) {
            return [];
        }

        return $sth->fetchAll();
    }

    private function initTables()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nickname TEXT NOT NULL,
            email TEXT NOT NULL
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS articles (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            author_id INTEGER NOT NULL,
            name TEXT NOT NULL,
            text TEXT NOT NULL,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP
        )");

        // Если таблица пользователей пуста — добавляем тестового автора и статью
        $count = $this->pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        if ((int)$count === 0) {
            $this->pdo->exec("INSERT INTO users (nickname, email) VALUES ('admin', 'admin@blog.ru')");
            $this->pdo->exec("INSERT INTO articles (author_id, name, text) VALUES (1, 'Первая статья в блоге', 'Текст первой тестовой статьи для проверки вывода автора.')");
        }
    }
}
