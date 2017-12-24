<?php

use app\routing\middleware\setLinkBack;
use app\routing\middleware\checkLogin;
use app\routing\middleware\csrf;
use app\routing\middleware\adminAccess;

$dispatcher->registerMiddleware('checkLogin', checkLogin::class);
$dispatcher->registerMiddleware('setLinkBack', setLinkBack::class);
$dispatcher->registerMiddleware('csrf', csrf::class);
$dispatcher->registerMiddleware('adminAccess', adminAccess::class);
