<?php

    namespace Services;

    use \PDO;

    class RegistrationService {
        // Form validation rules
        private $rules = [
            'first_name' => '/^.{3,15}$/u',
            'last_name' => '/^.{3,20}$/u',
            'birthdate' => '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/',
            'report_subject' => '/^.{1,200}$/u',
            'country_id' => '/^\d+$/',
            'phone' => '/^\d{12}$/',
            'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'company' => '/^.{0,200}$/u',
            'position' => '/^.{0,200}$/u',
            'about_me' => '/^.{0,200}$/u'
        ];
        private $errors = [];
        private string $media_path;


        public function __construct(string $media_path, string $dsn, string $user, string $password) {
            $this->media_path = $media_path;
            $this->pdo = new PDO($dsn, $user, $password);
        }

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
        public function register($object, $files = []) {
            // If form contains empty fields - set them to null
            foreach($object as $key => $value) {
                if ($value === '') {
                    $object[$key] = null;
                }
            }
            if (isset($files['photo'])){
                $object['photo'] = $this->savePhoto($files['photo']);
            } else {
                $object['photo'] = null;
            }
            // Add new user
            $query = $this->pdo->prepare("INSERT INTO users (first_name, last_name, birthdate, report_subject, country_id, phone, email, company, position, about_me, photo_path) VALUES (:first_name, :last_name, :birthdate, :report_subject, :country_id, :phone, :email, :company, :position, :about_me, :photo)");
            $query->execute($object);
        }
        
        // Function for saving photo in specific dir
        public function savePhoto($photo) {
            if (empty($photo) || !isset($photo['tmp_name']) || empty($photo['tmp_name'])) {
                return null; 
            }
            $target_file = $this->media_path . uniqid('IMG_', true) . '.' . strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
            $uploadOk = 1;
            // Check image is real
            $check = getimagesize($photo["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            // Check image size
            if ($photo["size"] > 5242880) {
                $uploadOk = 0;
            }
            // Saving image
            if ($uploadOk == 1) {
                if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                    return $target_file;
                }
            }
            // If something went wrong - return null
            return null;
        }

        public function getCountries() {
            // Receiving all countries from database
            $query = $this->pdo->prepare('SELECT * FROM countries');
            $query->execute();     
            $countries = $query->fetchAll(PDO::FETCH_ASSOC);

            return $countries;
        }

        public function getMembersCount() {
            // Receiving count of users
            $query = $this->pdo->prepare('SELECT COUNT(*) from users');
            $query->execute();
            $members_count = $query->fetchColumn();

            return $members_count;
        }

        public function getMembers() {
            // Receveing users data
            $query = $this->pdo->prepare('SELECT photo_path, first_name, last_name, report_subject, email FROM users');
            $query->execute();
            $users = $query->fetchAll(PDO::FETCH_ASSOC);

            return $users;
        }

        public function checkEmail($email) {
            // Receveing users data
            $query = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $query->execute([$email]);
            $is_email = $query->fetchColumn();

            return $is_email;
        }
    }
?>