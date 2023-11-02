<?php

namespace DesignPattern\Right\Http;

interface HttpAdapter
{
    public function post(string $url, array $data = []) : void;
}