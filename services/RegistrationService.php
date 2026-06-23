<?php

    namespace Services;

    use \PDO;

    class RegistrationService {
        // Form validation rules
        private $rules = [
            'first_name' => '/^.{3,15}$/',
            'last_name' => '/^.{3,20}$/',
            'birthdate' => '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/',
            'report_subject' => '/^.+$/',
            'country_id' => '/^\d+$/',
            'phone' => '/^\d{12}$/',
            'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'company' => '/.*/',
            'position' => '/.*/',
            'about_me' => '/.*/'
        ];
        private $errors = [];

        // Validating form
        public function validate($object): bool {
            $this->errors = [];
            $passed = true;
            foreach ($this->rules as $key => $value) {
                if (isset($object[$key])) {
                    if (!preg_match($value, $object[$key])) {
                        $passed = false;
                        $this->errors[$key] = "invalid data";
                    }
                } else {
                    $passed = false;
                    $this->errors[$key] = "field was deleted";
                }
            }
            return $passed;
        }

        public function getErrors(): mixed {
            return $this->errors;
        }

        // Registration user
        public function register($object) {
            // If form contains empty fields - set them to null
            foreach($object as $key => $value) {
                if ($value === '') {
                    $object[$key] = null;
                }
            }
            // Connection by dotenv data
            $pdo = new PDO($_ENV['dsn'], $_ENV['user'], $_ENV['password']);
            // Creates countries table if not exists
            $sql = '
                CREATE TABLE IF NOT EXISTS countries (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    country_name VARCHAR(50) NOT NULL UNIQUE
                );
            ';
            $pdo->exec($sql);
            // Creates users table if not exists
            $sql = '
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(15) NOT NULL,
                    last_name VARCHAR(20) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    birthdate DATE NOT NULL,
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
            // Add new user
            $query = $pdo->prepare("INSERT INTO users (first_name, last_name, birthdate, report_subject, country_id, phone, email, company, position, about_me) VALUES (:first_name, :last_name, :birthdate, :report_subject, :country_id, :phone, :email, :company, :position, :about_me)");
            $query->execute($object);
            
        }

        public function getCountries() {
            // Connection by dotenv data
            $pdo = new PDO($_ENV['dsn'], $_ENV['user'], $_ENV['password']);
            // Receiveng all countries from database
            $query = $pdo->prepare('SELECT * FROM countries');
            $query->execute();     
            $countries = $query->fetchAll(PDO::FETCH_ASSOC);

            return $countries;
        }
    }
?>