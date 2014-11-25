<?php

/*require_once "./Smarty/libs/Smarty.class.php";
require_once "./Configuration files/smartyConfig.php";*/


//chiamare la classe VMain ?
class VClinica extends Smarty {  

	public function __construct(){
		parent::__construct();

		global $smarty;
		
		$this->template_dir = $smarty['template_dir']; 
		$this->compile_dir = $smarty['compile_dir'];
		$this->cache_dir = $smarty['cache_dir'];
		$this->config_dir = $smarty['config_dir'];

	}

	public function get($key)
	{
		if (isset($_REQUEST[$key]))
			return $_REQUEST[$key];
		else
			return false;		
	}
}