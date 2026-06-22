<?php

    namespace Controllers;

    use \Utils\Interfaces\ControllerInterface;
    use \Utils\Traits\ControllerTrait;
    use \Core\Http\Request;
    use \Core\Http\Response;
    use \Services\RegistrationService;

    class MainController implements ControllerInterface {
        public $service;

        public function __construct(RegistrationService $service) {
            $this->service = $service;
        }

        public function post(Request $request): void {
            if ($this->service->validate($request->post)) {
                $this->service->register($request->post);
            }
        }
        public function get(Request $request): void {
            $response = new Response('views/index.php');
            $response->render([
                'countries' => $this->service->getCountries()
            ]);
        }
        // Adding handling function
        use ControllerTrait;
    }
?>