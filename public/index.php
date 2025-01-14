<?php

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

use App\Kernel\App;

$app = new App();

$app->run();

symlink(APP_PATH ."/public/storage", APP_PATH ."/storage/images");



