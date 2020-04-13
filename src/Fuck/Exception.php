<?php
namespace fuck;

class Exception extends \Exception
{
    protected $message = '';
    protected $httpCode = 500;
    public function __construct(string $message, int $httpCode = 500)
    {
        $this->message = $message;
        $this->httpCode = $httpCode;
    }
    public function getHttpCode(){
        return $this->httpCode;
    }
}
