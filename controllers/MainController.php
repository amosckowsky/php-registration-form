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
            $this->service->validate($request->post);
        }
        public function get(Request $request): void {
            require 'views/index.php';
        }
        // Adding handling function
        use ControllerTrait;
    }
?>