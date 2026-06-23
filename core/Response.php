<?php
    namespace Core\Http;

    // Response object
    class Response {
        public int $statusCode;
        public string $templatePath;
        public function __construct(string $templatePath, int $statusCode = 200) {
            $this->statusCode = $statusCode;
            $this->templatePath = $templatePath;
        }

        // Render with optional context
        public function render($context = []) {
            extract($context);
            http_response_code($this->statusCode);
            require $this->templatePath;
        }
    }
?>