<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\AuthController;


$auth = new AuthController();
$auth->logout();