<?php
    use Core\Routing\Router;
    use Controllers\MainController;
    use Core\Http\Request;

    include 'union.php';

    $config = require __DIR__ . '/config.php';

    loadRegistry($config['registry']);

    $router = new Router([
            '' => new MainController(),
            'test' => new MainController()
        ]);

    $request_url = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), strlen($config['baseURL']));
    $request = new Request($request_url, $_SERVER['REQUEST_METHOD'], $_POST, $_GET);
    $router->handle($request);
?>