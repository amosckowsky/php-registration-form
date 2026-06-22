<?php

    namespace Controllers;

    use \Utils\Interfaces\ControllerInterface;
    use \Core\Http\Request;
    use \Core\Http\Response;

    class MainController implements ControllerInterface {
        public function post(Request $request): void {
            
        }
        public function get(Request $request): void {
            require 'views/index.php';
        }
        public function handle(Request $request): void {
            if ($request->method === 'GET') {
                $response = new Response('views/index.php');
                $response->render();
            }
        }
    }
?>