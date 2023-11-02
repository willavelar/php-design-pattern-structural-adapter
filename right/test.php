<?php

use DesignPattern\Right\{Budget, Http\CurlHttpAdapter, RegisterBudget};

require "vendor/autoload.php";

$budget = new Budget();
$budget->items = 7;
$budget->value = 1500.75;

(new RegisterBudget(new CurlHttpAdapter()))->register($budget);