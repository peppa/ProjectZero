<?php
/**
 * @access public
 * @package View
 */

class View extends Smarty {
    public function __construct() {
        $this->Smarty();
        global $config;
        $this->template_dir = $config['smarty']['template_dir'];
        $this->compile_dir = $config['smarty']['compile_dir'];
        $this->config_dir = $config['smarty']['config_dir'];
        $this->cache_dir = $config['smarty']['cache_dir'];
        $this->caching = $config['smarty']['caching'];
    }
    /**
     * Restituisce il compito da eseguire
     * @return mixed
     */
    public function getTask() {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }
    /**
     * Restituisce il controllore
     * @return mixed
     */
    public function getController() {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }
}
?>