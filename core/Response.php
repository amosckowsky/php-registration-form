<?php
    namespace Core\Http;

    // Response object
    class Response {
        public int $status_code;
        public string $template_path;
        public function __construct(string $template_path, int $status_code = 200) {
            $this->status_code = $status_code;
            $this->template_path = $template_path;
        }

        // Render with optional context
        public function render($context = []) {
            extract($context);
            http_response_code($this->status_code);
            require $this->template_path;
        }
    }
?>