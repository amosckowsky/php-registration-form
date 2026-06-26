<?php
    use Core\Routing\Router;
    use Controllers\MainController;
    use Controllers\AllMembersController;
    use Services\RegistrationService;
    use Core\Http\Request;

    // Including registry functions
    include 'union.php';

    // Loading requirements
    require_once __DIR__ . '/vendor/autoload.php';

    // Loading dotenv file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Loading necessary data
    $config = require_once __DIR__ . '/config.php';

    $media_dir = $config['media_path'];
    if (!is_dir($media_dir)) {
        mkdir($media_dir);
    }
    
    // Loading registry
    loadRegistry($config['registry']);

    // Creating router
    $router = new Router([
            // Connecting controller to endpoint
            '' => new MainController(new RegistrationService($config['media_path'], $_ENV['dsn'], $_ENV['user'], $_ENV['password']), [
                    'tw_text' => $config['tw_text'],
                    'tw_url' => $config['tw_url'],
                    'baseURL' => $config['baseURL'],
                ]),
            'all_members' => new AllMembersController(new RegistrationService($config['media_path'], $_ENV['dsn'], $_ENV['user'], $_ENV['password']), [
                    'baseURL' => $config['baseURL']
                ])
        ]);

    // Clearing request url to obtain endpoints
    $request_url = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), strlen($config['baseURL']));
    // Creating request object
    $request = new Request($request_url, $_SERVER['REQUEST_METHOD'], $_POST, $_GET, $_FILES);
    // Start of processing request
    $router->handle($request);
?>