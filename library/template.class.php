<?php
class Template {
	 protected $variables = array();
	 protected $_controller;
	 protected $_action;
	 protected $_switch = true;

	function __construct($controller,$action) {
		 $this->_controller = $controller;
		 $this->_action =$action;
	 }

	/* 设置变量 */
 	function set($name,$value) {
 		$this->variables[$name] = $value;
 	}

	/* 显示模板 */
	function render() {
	 	extract($this->variables);
		 if (file_exists(ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. 'header.php')) {
		 	include(ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. 'header.php');
		 } else {
		 	include(ROOT.DS. 'application' .DS. 'views' .DS. 'header.php');
		 }
		 	include (ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. $this->_action . '.php');
		 if (file_exists(ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. 'footer.php')) {
		 	include (ROOT.DS. 'application' .DS. 'views' .DS. $this->_controller .DS. 'footer.php');
		 } else {
		 	include (ROOT.DS. 'application' .DS. 'views' .DS. 'footer.php');
		 }
	}
	/* 显示默认模版 */
	function autoRender($switch=true) {
		if($switch==null){
			$switch = $this->_switch;
		}
		if($switch){ //自动加载layout模版
			if (file_exists(ROOT.DS. 'application' .DS. 'views' .DS. 'Layouts' .DS. 'Default.php')) {
		 		include(ROOT.DS. 'application' .DS. 'views' .DS. 'Layouts' .DS. 'Default.php');
		 	}
		 	include(ROOT.DS. 'application' .DS. 'views' .DS. 'Layouts' .DS. 'test.php');
		}

	}
 }