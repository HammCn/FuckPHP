<?php
namespace fuck;

class App
{
    const VERSION = '1.0.0';
    protected $debug = false;
    protected $request;
    protected $response;
    protected $beforeArg;
    public function __construct()
    {
        //获取request和response对象
        $this->request = new Request();
        $this->response = new Response();
    }
    public function test()
    {
        echo 123;die;
    }
    public function request()
    {
        return $this->request;
    }
    public function response()
    {
        return $this->response;
    }
    public function run()
    {
        return $this->initController();
    }
    /**
     * 初始化控制器
     *
     * @return void
     */
    private function initController()
    {
        $controller = "./app/" . $this->request->module() . "/controller/" . $this->request->controller() . ".php";
        if (is_file($controller)) {
            $controller = "app\\" . $this->request->module() . "\\controller\\" . $this->request->controller();
            $action = $this->request->action();
        } else {
            $controller = "./app/" . $this->request->module() . "/controller/Default.php";
            if (is_file("./" . $controller . ".php")) {
                $controller = "app\\" . $this->request->module() . "\\controller\\Default";
                $action = "index";
            } else {
                return $this->error('Controller not found');
            }
        }
        $class = new $controller($this);
        if (method_exists($class, "__init")) {
            $this->beforeArg = $class->__init();
        } else {
            $this->beforeArg = null;
        }
        if (!method_exists($class, $action)) {
            $action = '__default';
            if (!method_exists($class, $action)) {
                return $this->error('Action not found');
            }
        }
        $result = $class->$action($beforeArg);
        if (is_object($result)) {
            $result_class = get_class($result);
            if ($result_class == "fuck\Response") {
                return $result;
            } else {
                return $this->error($result_class . ' not surpport');
            }
        } else if (is_array($result)) {
            $result = implode(",", $result);
        } else {
            //简单数字
            $result = (string) $result;
        }
        return $this->response->html($result);
    }
    private function error($message, $title = 'FuckPHP')
    {
        return $this->response->html('<html><head><title>' . $title . '</title></head><body><center><h1>' . $message . '</h1><hr>Powered by FuckPHP</center></body></html>');
    }
}
