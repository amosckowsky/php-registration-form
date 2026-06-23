<?php
    namespace Core\Http;

    // JSON Response object
    class ResponseJSON {
        public int $statusCode;
        public mixed $data;
        public function __construct(mixed $data, int $statusCode = 200) {
            $this->statusCode = $statusCode;
            $this->data = $data;
        }

        // Render json response
        public function render() {
            http_response_code($this->statusCode);
            echo json_encode($this->data);
        }
    }
?>