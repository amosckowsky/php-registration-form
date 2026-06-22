<?php
    // Settings of project
    return [
        'baseURL' => '/php-registration-form/',
        'registry' => [
            'utils' => ['ControllerTrait', 'ControllerInterface'],
            'core' => ['Request', 'Response', 'Router'],
            'services' => ['RegistrationService'],
            'controllers' => ['MainController']
        ]
    ];
?>