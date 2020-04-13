<?php
namespace fuck;

class Request
{
    private $_gets;
    private $_posts;
    private $_request;
    private $_cookies;
    private $_server;
    private $_module;
    private $_controller;
    private $_action;
    public function __construct()
    {
        $getArr = [];
        $defaultModule = 'api';
        $defaultController = 'index';
        $defaultAction = 'index';
        $this->_module = $defaultModule;
        $this->_controller = $defaultController;
        $this->_action = $defaultAction;
        //初始化Get参数
        $this->initGets();
        //初始化Post参数
        $this->initPosts();
        //初始化Cookies参数
        $this->initCookies();
    }
    /**
     * 初始化Cookie参数
     *
     * @return void
     */
    private function initCookies()
    {

    }
    /**
     * 初始化Post参数
     *
     * @return void
     */
    private function initPosts()
    {

    }
    /**
     * 初始化Get参数
     *
     * @return void
     */
    private function initGets()
    {
        if (array_key_exists('fuck', $_GET)) {
            $fuckArray = explode("/", $_GET['fuck']);
            $this->_module = count($fuckArray) >= 3 ? strtolower($fuckArray[2]) : $this->_module;
            $this->_controller = count($fuckArray) >= 4 ? ucfirst($fuckArray[3]) : $this->_controller;
            $this->_action = count($fuckArray) >= 5 ? $fuckArray[4] : $this->_action;
            unset($_GET['fuck']);
        }
        $this->_gets = $_GET;
    }
    /**
     * 获取GET参数
     *
     * @param  string|null 参数名称
     * @return string|array 参数值
     */
    public function get($key = null)
    {
        if ($key) {
            return $this->_gets[$key];
        } else {
            return $this->_gets;
        }
    }
    /**
     * 获取POST参数
     *
     * @param  string|null 参数名称
     * @return string|array 参数值
     */
    public function post($key = null)
    {
        if ($key) {
            return $this->_post[$key];
        } else {
            return $this->_post;
        }
    }
    /**
     * 获取当前模块
     *
     * @return void
     */
    public function module()
    {
        return $this->_module;
    }
    /**
     * 获取当前控制器
     *
     * @return void
     */
    public function controller()
    {
        return $this->_controller;
    }
    /**
     * 获取当前操作方法
     *
     * @return void
     */
    public function action()
    {
        return $this->_action;
    }
}
