<?php
    function loadFiles(mixed $registryObject, string $objectKey) {
        foreach ($registryObject as $file) {
                require_once "$objectKey/$file.php";
            }
    }

    function loadRegistry(mixed $registry) {
            loadFiles($registry['utils'], 'utils');
            loadFiles($registry['core'], 'core');
            loadFiles($registry['services'], 'services');
            loadFiles($registry['controllers'], 'controllers');
    }
?>