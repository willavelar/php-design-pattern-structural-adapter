<?php

use DesignPattern\Wrong\Budget;
use DesignPattern\Wrong\RegisterBudget;

require "vendor/autoload.php";

$budget = new Budget();
$budget->items = 7;
$budget->value = 1500.75;

(new RegisterBudget())->register($budget);