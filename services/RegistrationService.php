<?php

    namespace Services;

    use \PDO;

    class RegistrationService {
        public $rules = [
            'first_name' => '^.{3,15}$',
            'last_name' => '^.{3,20}$',
            'birthdate' => '^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$',
            'report_subject' => '^(.*)$',
            'country_id' => '^\d+$',
            'phone' => '^(\+\d{12})$',
            'email' => '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'
        ];

        public function validate($object): bool {
            $passed = true;
            foreach ($this->rules as $key => $value) {
                if (isset($object[$key])) {
                    if (!preg_match($value, $object[$key])) {
                        $passed = false;
                    }
                } else {
                    $passed = false;
                }
            }
            return $passed;
            
        }

        public function register($object) {
            $pdo = new PDO($_ENV['dsn'], $_ENV['user'], $_ENV['password']);
            $sql = '
                CREATE TABLE IF NOT EXISTS countries (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    country_name VARCHAR(50) NOT NULL UNIQUE
                );
            ';
            $pdo->exec($sql);
            $sql = '
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(15) NOT NULL,
                    last_name VARCHAR(20) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    birdthdate DATE NOT NULL,
                    report_subject TEXT NOT NULL,
                    country_id INT NOT NULL,
                    phone VARCHAR(13) NOT NULL,
                    company TEXT NULL,
                    position TEXT NULL,
                    about_me TEXT NULL,
                    photo_path TEXT NULL,
                    FOREIGN KEY (country_id) REFERENCES countries(id)
                );
            ';
            $pdo->exec($sql);
            $query = $pdo->prepare("INSERT INTO users (first_name, last_name, birdthdate, report_subject, country, phone, email) VALUES (:first_name, :last_name, :birdthdate, :report_subject, :country, :phone, :email)");
            $query->execute($object);
            
        }

        public function update() {

        }
    }
?>