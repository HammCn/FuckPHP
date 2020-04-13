<?php
namespace fuck;

class Response
{
    private $httpCode = 200;
    private $contentType = 'text/html';
    private $charSet = 'utf-8';
    private $body = '';
    private $header = [];
    public function __construct()
    {
    }
    public function setHeader()
    {

    }
    public function setBody()
    {

    }
    public function json(array $array)
    {
        $this->contentType = 'application/json';
        $this->body = json_encode($array);
        return $this;
    }
    public function html()
    {

    }
    public function xml()
    {

    }
    public function redirect($url, $httpCode = 302)
    {
        $this->httpCode = $httpCode;
        header('Location: ' . $url);
        die;
    }
    public function end()
    {
        foreach ($this->header as $k => $v) {
            if (!in_array(strtolower($k), ['status', 'content-type'])) {
                header($k . ": " . $v);
            }
        }
        header('Content-Type: ' . $this->contentType . "; charset=" . $this->charSet);
        echo $this->body;
        die;
    }
}
