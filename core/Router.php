<?php
    namespace Core\Routing;

    use \Core\Http\Request;

    class Router {
        private int $nesting = 0;
        private $routes = [];
        public function __construct($routes = []) {
            foreach($routes as $key => $value) {
                if ($value instanceof Router) {
                    $value.set_nest($this->nesting+1);
                }
                $this->routes[$key] = $value;
            }
        }
        public function handle(Request $request) {
            if (array_key_exists($request->listPath[$this->nesting], $this->routes)) {
                $this->routes[$request->listPath[$this->nesting]]->handle($request);
            } else {
                http_response_code(404);
            }
        }

        public function set_nest(int $nest) {
            $this->nesting = $nest;
        }
    }
?>