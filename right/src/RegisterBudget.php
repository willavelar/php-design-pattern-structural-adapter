<?php

namespace DesignPattern\Right;

use DesignPattern\Right\Http\HttpAdapter;

class RegisterBudget
{
    private HttpAdapter $http;

    public function __construct(HttpAdapter $http)
    {
        $this->http = $http;
    }

    public function register(Budget $budget) : void
    {
        $this->http->post('"https://www.example.com/', $budget->toArray());
    }
}