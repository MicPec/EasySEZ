<?php

define('APP_NAME', 'EasySEZ');
define('APP_VERSION', '0.1m');

// define('STATE', [0=>'', 1=>'start', 2=>'progress', 3=>'end']);
// echo STATE['start'];

$container->get('response')->filter(function ($body) use ($container) {
    $toolbar = $container->get('toolbar')->render();

    return str_replace('</body>', $toolbar.'</body>', $body);
});
