<?php
    namespace Core\Http;

    // Request object
    class Request {
        public readonly string $path;
        public readonly mixed $listPath;
        public readonly string $method;
        public mixed $post;
        public mixed $query;

        public function __construct(string $path, string $method = 'GET', mixed $post = [], mixed $query = []) {
            $this->path = $path;
            $this->listPath = explode('/', $path);
            $this->method = $method;
            $this->post = $post;
            $this->query = $query;
        }
    }
?>