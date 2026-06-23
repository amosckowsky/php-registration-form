<?php
    namespace Core\Http;

    // JSON Response object
    class ResponseJSON {
        public int $status_code;
        public mixed $data;
        public function __construct(mixed $data, int $status_code = 200) {
            $this->status_code = $status_code;
            $this->data = $data;
        }

        // Render json response
        public function render() {
            http_response_code($this->status_code);
            echo json_encode($this->data);
        }
    }
?>