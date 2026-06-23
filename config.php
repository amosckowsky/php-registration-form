<?php
    // Settings of project
    return [
        'baseURL' => '/php-registration-form/',
        'registry' => [
            'utils' => ['ControllerTrait', 'ControllerInterface'],
            'core' => ['Request', 'Response', 'ResponseJSON','Router'],
            'services' => ['RegistrationService'],
            'controllers' => ['MainController']
        ],
        'tw_text' => 'Check out this Meetup with SoCal AngularJS!'
    ];
?>