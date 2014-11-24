<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * Description of VHome
 *
 * @access public
 * @package VHome
 * @author Carlo
 */

/*
 * TO DO LIST
 * 
 * 
 * l'header ci deve essere sempre con il menu di navigazione. va caricato.
 * 
 * devo creare: 
 * logoutButton.tpl
 * footer.tpl
 * 
 */
class VHome extends View{   
    

    
    public function impostaLoginForm() {
        $form=$this->fetch('login.tpl');
        $this->assign('loginBox',$form);
        
    }
    
    public function impostaLogoutButton() {
        $button=  $this->fetch('loggedIn.tpl');
        $this->assign('loginBox', $button);
        
        
    }
    
    public function impostaFooter() {
        $footer= $this->fetch('footer.tpl');
        $this->assign('footer', $footer);
        
    }
    
    public function impostaHome() {
        //$home_Body=  $this->fetch('HomeBody.tpl');
        $home_Body="qua ci va il body della home... manca ancora il tpl e va cambiato il commento su VHome.php in modo da fare la fetch";
        $this->impostaBody($home_Body);
        
    }
    
    public function impostaBody($body) {
        $this->assign('body', $body);
        
    }
    
    public function visualizza() {
        
        $this->display('home.tpl');
        
    }
    
    
}

?>