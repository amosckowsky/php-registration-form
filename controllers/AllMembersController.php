<?php

    namespace Controllers;

    use \Utils\Interfaces\ControllerInterface;
    use \Utils\Traits\ControllerTrait;
    use \Core\Http\Request;
    use \Core\Http\Response;
    use \Core\Http\ResponseJSON;
    use \Services\RegistrationService;

    class AllMembersController implements ControllerInterface {
        public $service;
        public $kwargs;
        public function __construct($service, $kwargs = []) {
            $this->service = $service;
            $this->kwargs = $kwargs;
        }

        public function post(Request $request): void {
            $response = new ResponseJSON(['is_email' => $this->service->checkEmail($request->post['email'])]);
            $response->render();
        }

        public function get(Request $request): void {
            $response = new Response('views/all_members.php');
            $response->render([
                // Get members data from database
                'users' => $this->service->getMembers(),
                'baseURL' => $this->kwargs['baseURL']
            ]);
        }
        // Adding handling function
        use ControllerTrait;
    }
?>