<?php

    namespace Controllers;

    use \Utils\Interfaces\ControllerInterface;
    use \Utils\Traits\ControllerTrait;
    use \Core\Http\Request;
    use \Core\Http\Response;
    use \Core\Http\ResponseJSON;
    use \Services\RegistrationService;

    class MainController implements ControllerInterface {
        public $service;
        public mixed $kwargs;

        public function __construct(RegistrationService $service, mixed $kwargs = []) {
            $this->service = $service;
            $this->kwargs = $kwargs;
        }

        public function post(Request $request): void {
            // Check validation
            if ($this->service->validate($request->post)) {
                // If form is valid - register user
                $this->service->register($request->post);
            }
            // Sending response with errors
            $response = new ResponseJSON($this->service->getErrors());
            $response->render();

        }
        public function get(Request $request): void {
            $response = new Response('views/index.php');
            $response->render([
                'countries' => $this->service->getCountries(),
                // Adding text for twitter post
                'tw_text' => $this->kwargs["tw_text"]
            ]);
        }
        // Adding handling function
        use ControllerTrait;
    }
?>