<?php

/*
 * File creato da Carlo Centofanti
 */

/**
 * CHome è il controllore principale. si occupa di riconoscere e smistare
 * tutte le richieste sui vari controllori.
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
     * richiedi pagina si occupa di costruire la pagina e fare in modo che venga
     * visualizzata
     */
    public function richiediPagina() {
        $this->impostaPagina();
        $this->visualizzaPagina();
        
    }
    
    public function impostaPagina() {
        $this->caricaLoginBox();
        $this->caricaBody();
        $this->caricaFooter();
        
    }
    
    public function caricaLoginBox() {
        $VHome= USingleton::getInstance('VHome');
        //$VHome= new VHome(); //riga da eliminare
        
        if(!$this->loggato()){
            $VHome->impostaLoginForm();
        }
        else $VHome->impostaLogoutButton();
        
    }
    
    public function caricaBody() {
        return $this->smista(); //vedere cosa restituisce smista e se conviene restituire HTML o no
        
    }
    
    public function caricaFooter() {
        $VHome=  USingleton::getInstance('VHome');
        
        $VHome->impostaFooter();
        
    }
    
    public function visualizzaPagina() {
        $VHome= USingleton::getInstance('VHome');
        //$VHome=new VHome();//da eliminare
        $VHome->visualizza();
           
    }
    
    /*
     * verifica se l'utente è loggato. forse va in una classe CRuolo, che è in
     * grado di determinare il ruolo dell'utente (medico, paziente admin)
     */
    public function loggato(){
        $USession=  USingleton::getInstance('USession');
        if ($USession->get('username')){
            return TRUE;            
        }else return FALSE;
    }
    
    public function smista() {
        $VHome=  USingleton::getInstance('VHome');
        //$VHome=new VHome(); //riga da rimuovere
        
        $controllore=$VHome->getController();
       
        
        switch ($controllore) {
            case 'manageDB':
                $CPatientsDB=  USingleton::getInstance('CPatientsDB');
                $CPatientsDB->impostaHomeDB();
                break;
            

            default:
                $VHome->impostaHome();
                
                break;
        }
        
    }
    
}

?>