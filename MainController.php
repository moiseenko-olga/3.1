<?php

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/templates');
    }

    public function main()
    {
        $this->view->renderHtml('main/main.php');
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello.php', [
            'name'  => $name,
            'title' => 'Страница приветствия'
        ]);
    }

    public function sayBye(string $name)
    {
        echo 'Пока, ' . htmlspecialchars($name);
    }
}
