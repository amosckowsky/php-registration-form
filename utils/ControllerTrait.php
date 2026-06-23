<?php
    namespace Utils\Traits;

    use \Core\Http\Request;

    // Handling function for all controllers
    trait ControllerTrait {
        public function handle(Request $request): void {
            if ($request->method == 'GET') {
                $this->get($request);
            } else if ($request->method == 'POST') {
                $this->post($request);
            }
        }
    }
?>