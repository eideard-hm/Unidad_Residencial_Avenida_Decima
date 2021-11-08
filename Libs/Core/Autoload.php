<?php

spl_autoload_register(function ($class) {
    if (file_exists('Libs/Core/' . $class . ".php")) {
        require_once('Libs/Core/' . $class . ".php");
    }
});
