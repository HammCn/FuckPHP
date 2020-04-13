<?php
namespace fuck;
use app\admin\controller\Test;
class App
{
    const VERSION = '1.0.0';
    protected $debug = false;
    protected $request = null;
    public function __construct()
    {

    }
    public function run()
    {
        $this->request = new Request();
        return $this->initController();
    }
    private function initController()
    {
        $controller = "./app/" . $this->request->module() . "/controller/" . $this->request->controller() . ".php";
        $action = $this->request->action();
        if (!is_file($controller)) {
            $controller = "./app/" . $this->request->module() . "/controller/Default.php";
            $action = "index";
            if (!is_file($controller)) {
                $controller = new Controller();
                return $controller->error('Controller not found!');
            }
        }
        $controller = "app\admin\controller\Test";
        print_r(new $controller());
    }
}
