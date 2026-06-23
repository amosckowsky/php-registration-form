<?php
    // Settings of project
    return [
        'baseURL' => '/php-registration-form/',
        'media_path' => 'media/',
        'registry' => [
            'utils' => ['ControllerTrait', 'ControllerInterface'],
            'core' => ['Request', 'Response', 'ResponseJSON','Router'],
            'services' => ['RegistrationService'],
            'controllers' => ['MainController']
        ],
        'tw_url' => 'https://albedo.dev/',
        'tw_text' => 'Check out this Meetup with SoCal AngularJS!'
    ];
?>