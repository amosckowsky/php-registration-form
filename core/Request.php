<?php
    namespace Core\Http;

    // Request object
    class Request {
        public readonly string $path;
        public readonly mixed $list_path;
        public readonly string $method;
        public mixed $post;
        public mixed $query;
        public mixed $files;

        public function __construct(string $path, string $method = 'GET', mixed $post = [], mixed $query = [], mixed $files = []) {
            $this->path = $path;
            $this->list_path = explode('/', $path);
            $this->method = $method;
            $this->post = $post;
            $this->query = $query;
            $this->files = $files;
        }
    }
?>