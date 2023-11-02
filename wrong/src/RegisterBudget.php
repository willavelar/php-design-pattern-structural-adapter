<?php

namespace DesignPattern\Wrong;

class RegisterBudget
{
    public function register(Budget $budget) : void
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.example.com/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($budget->toArray()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        if ($server_output == "OK") {
            echo "OK";
        } else {
            echo "FAIL";
        }
    }
}