<?php

/**
 * Create a autoloader used to lazy load required classes as and when they're required by the app.
 */
spl_autoload_register(function($class) {

    // Convert the fully qualified class name to an array to make it easier to work with
    $class_name = explode('\\', $class);
    $path = __DIR__ . '/' . implode('/', $class_name) . '.php';

    if(file_exists($path)) {
        require_once $path;
        return true;
    } else {
        return false;
    }

});

