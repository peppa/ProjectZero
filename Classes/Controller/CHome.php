<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * CHome is the main controller. It has to identify and switch all requests to 
 * the right controller.
 *
 * @access public
 * @package CHome
 * @author Carlo
 */


/*
 * TO DO LIST:
 * 
 * 
 * 
 * 
 * smista()
 * 
 */
class CHome {
    /**
     * start is the main function. It builds the requested page and shows it
     * 
     */
    public function start() {
        $this->setPage();
        $this->showPage();
        
    }
    
    /*
     * It sets the login Box, the Body and the Footer of the page
     */
    public function setPage() {
        $this->loadLoginBox();
        $this->loadBody();
        $this->loadFooter();
        
    }
    
    /*
     * Loads the login box if not logged yet or the logout button
     */
    public function loadLoginBox() {
        $VHome= USingleton::getInstance('VHome');
        
        if(!$this->isLoggedIn()){
            $VHome->setLoginForm();
        }
        else $VHome->setLogoutButton();
        
    }
    
    /*
     * Demands to the switchControl to process the body
     */
    public function loadBody() {
        return $this->switchControl(); 
        
    }
    
    /**
     * Loads the Footer
     */
    public function loadFooter() {
        $VHome=  USingleton::getInstance('VHome');
        $VHome->setFooter();
        
    }
    
    /*
     * It asks to the wiev layer to show the page
     */
    public function showPage() {
        $VHome= USingleton::getInstance('VHome');
        $VHome->visualize();
           
    }
    
    /*
     * Checks if user is logged in. forse va in una classe CRuolo, che è in
     * grado di determinare il ruolo dell'utente (medico, paziente admin)?
     */
    public function isLoggedIn(){
        $USession=  USingleton::getInstance('USession');
        return $USession->isLogged();
           
    }
    
    /*
     * It is the function which decides which controller has to be called to
     * build and set the correct contents
     */
    public function switchControl() {
        $VHome=  USingleton::getInstance('VHome');        
        $controller=$VHome->getController();       
        
        switch ($controller) {
            case 'manageDB':
                $CPatientsDB=  USingleton::getInstance('CPatientsDB');
                $CPatientsDB->setHomePatients();
                break;
            

            default:
                $VHome->setHomepage();
                
                break;
        }
        
    }
    
}

?>