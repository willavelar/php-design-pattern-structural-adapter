## Adapter

Adapter is a structural design pattern that allows objects with incompatible interfaces to collaborate.

-----

We need to create a budget and then register it in an API

### The problem

One of the ways we can do this is using curl, or also with an http package, there are several ways, and if we were to use it in another call, we would need to repeat everything again.

```php
<?php
class Budget
{
    public float $value;
    public int $items;

    public function toArray() : array
    {
        return [
            'value' => $this->value,
            'items' => $this->items
        ];
    }
}
```
```php
<?php
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
```
```php
<?php
$budget = new Budget();
$budget->items = 7;
$budget->value = 1500.75;

(new RegisterBudget(new CurlHttpAdapter()))->register($budget);
```


### The solution

Now, using the Adapter pattern, we make it only call the post method, which is what the class needs to know, and so through dependency inversion, we can easily change how this request will be made

```php
<?php
interface HttpAdapter
{
    public function post(string $url, array $data = []) : void;
}
```
```php
<?php
class CurlHttpAdapter implements HttpAdapter
{
    public function post(string $url, array $data = []): void
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
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
```
```php
<?php
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
```
```php
<?php
$budget = new Budget();
$budget->items = 7;
$budget->value = 1500.75;

(new RegisterBudget(new CurlHttpAdapter()))->register($budget);
```
-----

### Installation for test

![PHP Version Support](https://img.shields.io/badge/php-7.4%2B-brightgreen.svg?style=flat-square) ![Composer Version Support](https://img.shields.io/badge/composer-2.2.9%2B-brightgreen.svg?style=flat-square)

```bash
composer install
```

```bash
php wrong/test.php
php right/test.php
```