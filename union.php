<?php
    // Function for loading all files from registryObject
    function loadFiles(mixed $registryObjects, string $objectKey) {
        foreach ($registryObjects as $file) {
                require_once "$objectKey/$file.php";
            }
    }

    // Function for loading all necessary files that indicated in registry
    function loadRegistry(mixed $registry) {
            loadFiles($registry['utils'], 'utils');
            loadFiles($registry['core'], 'core');
            loadFiles($registry['services'], 'services');
            loadFiles($registry['controllers'], 'controllers');
    }
?>