<?php
    namespace Utils\Interfaces;

    use \Core\Http\Request;

    interface ControllerInterface {
        public function get(Request $request): void;
        public function post(Request $request): void;
        public function handle(Request $request): void;
    }
?>