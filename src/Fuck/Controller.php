<?php
namespace fuck;

class Controller
{
    public function __construct()
    {

    }
    public function test()
    {
        return "Hello World!";
    }
    public function error($message, $title = '系统错误', $httpCode = 200)
    {
        $response = new Response();
        $response->setHTML= require(__DIR__."/../pages/error.php");
        return $response;
    }
}
