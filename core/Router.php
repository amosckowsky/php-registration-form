<?php
    namespace Core\Routing;

    use \Core\Http\Request;

    // Creating class to containing endpoints
    // Endpoints can contain Controller or another Router
    class Router {
        // Nesting is an andicator of how far down the URL chain the current Router is located
        private int $nesting = 0;
        // Storage of endpoints and Controllers/Routers
        private $routes = [];
        public function __construct($routes = []) {
            // Iterating endpoints and Controllers/Routers
            foreach($routes as $key => $value) {
                // If a router as attached to the endpoint - its nesting will be 1 unit greater
                if ($value instanceof Router) {
                    $value.set_nest($this->nesting+1);
                }
                // Pair Controller/Router to endpoint
                $this->routes[$key] = $value;
            }
        }
        // Action transfer function
        public function handle(Request $request) {
            // If enpoint exists in current router - call handle of paired object
            if (array_key_exists($request->list_path[$this->nesting], $this->routes)) {
                if (!($this->routes[$request->list_path[$this->nesting]] instanceof Router)) {
                    if (count($request->list_path)-1 > $this->nesting && $request->list_path[$this->nesting+1] != '') {
                        http_response_code(404);
                        return null;
                    }
                }
                $this->routes[$request->list_path[$this->nesting]]->handle($request);
            // Else throw 404 page
            } else {
                http_response_code(404);
            }
        }
        
        public function set_nest(int $nest) {
            $this->nesting = $nest;
        }
    }
?>