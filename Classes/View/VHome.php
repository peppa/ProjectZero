<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * VHome is the View layer of the main controller CHome.
 *
 * @access public
 * @package VHome
 * @author Carlo
 */

/*
 * TO DO LIST
 * 
 *
 * 
 * 
 */
class VHome extends View{   
    

    /*
     * Set the login Form
     */
    public function setLoginForm() {
        $form=$this->fetch('login.tpl');
        $this->assign('loginBox',$form);
        
    }
    
    /*
     * Sets the logout button
     */
    public function setLogoutButton() {
        $button=  $this->fetch('loggedIn.tpl');
        $this->assign('loginBox', $button);
        
        
    }
    
    /*
     * sets the Footer
     */
    public function setFooter() {
        $footer= $this->fetch('footer.tpl');
        $this->assign('footer', $footer);
        
    }
    
    /*
     * Sets the Homepage's Body content
     */
    public function setHomepage() {
        //$home_Body=  $this->fetch('HomeBody.tpl');
        $home_Body="qua ci va il body della home... manca ancora il tpl e va cambiato il commento su VHome.php in modo da fare la fetch";
        $this->setBody($home_Body);
        
    }
    
    /*
     * Sets the body passed as parameter
     * 
     * @param $body the fetched HTML body
     */
    public function setBody($body) {
        $this->assign('body', $body);
        
    }
    
    /**
     * Displays the page
     */
    public function visualize() {
        
        $this->display('home.tpl');
        
    }
    
    
}

?>