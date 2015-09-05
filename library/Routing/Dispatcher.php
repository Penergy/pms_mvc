<?php
 /*
  * Dispatcher: 解析URL，是不同url提供不同request
  * 
  * 1. pms_mvc
  * 2. pms_mvc/controllers
  * 3. pms_mvc/controllers/action
  * 
  */

class Dispatcher{
  
	public $request;

	private $url_status; //几种url选择
	private $controller;
	private $action;
	private $request_parameters;
	private $queryString;
	/**
	 * Constructor.
	 *
	 * @param string $base The base directory for the application. Writes `App.base` to Configure.
	 */
	public function __construct($base = false) {
		if ($base !== false) {
			Configure::write('App.base', $base);
		}
	}

	/**
	 * 解析url信息.
	 *
	 * @param string request请求的url字符串
	 * @return array 返回数组 controller，action，相关参数
	 */
	public function _URL_parser($url){

		$urlArray = array();
	    if($url ==''){ //如果是域名首地址 www.example.com or www.example.com/example
	       $this->url_status = 1;
	       $this->run();
	       return;
	    }else{
	    	$urlArray = explode("/",$url);
	    	if(count($urlArray)==1){
	    		$this->url_status = 2;
	    		$this->controller = $urlArray[0];
	    		$this->action = 'index';
	    		$this->run();
	    	}elseif(count($urlArray)==2){
	    		$this->url_status = 3;
	    		$this->controller = $urlArray[0];
	    		array_shift($urlArray);
			    $this->action = $urlArray[0];
			    $this->queryString = array(); //TODO
			    $this->run();
			   
	    	}else{
	    		$this->url_status = 3;
	    		$this->controller = $urlArray[0];
	    		array_shift($urlArray);
			    $this->action = $urlArray[0];
			    array_shift($urlArray);
			    $this->queryString = $urlArray; //TODO
			    $this->run();
	    	}
	    }
	    
	}

	/**
	 * TODO
	 */
	protected function run(){
		if($this->url_status == 1){
			$template = new Template('','');
	        $template->autoRender();
	        return;
		}else{
			$controllerName = $this->controller;
		    $controller = ucwords($this->controller);
		    $model = rtrim($controller, 's');
		    $controller .= 'Controller';
		    $go_dispatch = new $controller($model,$controllerName,$this->action);
		    // fb(array($controller, $this->action));
		    if ((int)method_exists($controller, $this->action)) {
		        call_user_func_array(array($go_dispatch,$this->action),$this->queryString);
		    } else {
		        /* 生成错误代码 */
		    }
		    return;
		}
	}
}
