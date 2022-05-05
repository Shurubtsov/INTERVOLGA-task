<?php
namespace App;
require_once __DIR__."/vendor/autoload.php";

use App\Controller\Hello;
$controller = new Hello();
$controller->display();