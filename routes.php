<?php

return [
    '~^articles/(\d+)$~' => [ArticlesController::class, 'show'],
    '~^hello/(.*)$~'      => [MainController::class, 'sayHello'],
    '~^bye/(.*)$~'        => [MainController::class, 'sayBye'],
    '~^$~'                => [MainController::class, 'main'],
];
