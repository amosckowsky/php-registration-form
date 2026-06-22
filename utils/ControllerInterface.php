<?php
    namespace Utils\Interfaces;

    use \Core\Http\Request;

    interface ControllerInterface {
        public function get(Request $request): void;
        public function post(Request $request): void;
        // The handling function selecting which of the methods (post or get) should be used
        public function handle(Request $request): void;
    }
?>