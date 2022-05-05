<?php
namespace App;
require_once __DIR__."/vendor/autoload.php";

// Первое задание, добавить контроллер для вызова "helloworld"
use App\Controller\Hello;
$display = new Hello();
print_r($display->display());