<?php


class USession {
        
	private $holdtime;

        /**
	 * Initializes the session or resumes it.
         * 
	 */
	public function __construct() {
            global $config;
            $this->holdtime=$config['cookie']['holdtime'];
            session_start();
            $this->updateCookie();
	}

        /**
	 * function login
	 * 
	 * Logs a user in.
	 * 
	 * @param string $username
	 * @param string $password
	 */
	public function login($user,$pass){
		$this->set('username',$user);
		$this->set('password',$pass);
	}

        /**
	 * function logout
	 * 
	 * Removes the data of the session frome the server's file system.
	 * 
	 * @todo The file is truncated (to 0 byte) but it is not deleted from the file system. Need to fix it.
	 */
	public function logout(){
		unset($_SESSION["username"]);
		unset($_SESSION["password"]);
		unset($_SESSION["keepLogged"]);

		$this->updateCookie();
	}

        /**
	 * Checks if the user is logged in.
	 * 
	 * It checks the $_SESSION variable, if it contains the correct user and password (according 
	 * to the User table of the application database), then the user is logged in.
	 * 
	 * @return bool 
	 */
	public function isLogged(){

            if (isset($_SESSION['username']) and isset($_SESSION['password'])){
                $logged=true;
            }
            else {$logged=false;}
            return $logged;
		
	}

        /**
	 * function set
	 * 
	 * Stores a value in an associative array. This values can be reused till session expires.
	 *  
	 * @todo this method shouldn't be in Registration class.
	 * @param mixed $key 
	 * @param mixed $value
	 */
	public function set($key, $value){
            $_SESSION[$key]=$value;
	}

        /**
	 * function get 
	 * 
	 * Gets a value stored in the session array at the key passed position.
	 * 
	 * @param mixed $key
	 * @return mixed
	 */
	public function get($key)
	{
		if(isset($_SESSION[$key]))
                    return $_SESSION[$key];
		else
                    return false;
	}

        /**
	 * Sets the desired behaviour of the session.
	 * 
	 * If $value is true the session will last for the time setted in the config,
         * otherwise it will expire at browser's closing.
	 * 
	 * @param bool $value
	 */
	public function keepAccess($value){
		$_SESSION['keepLogged']=$value;
		$this->updateCookie();
	}

        /**
	 *  Updates the cookie.
	 *  
	 *  When the "keepLogged" session variable is changed, this method should be called to 
	 *  update the cookie. 
	 */
	public function updateCookie(){
		if($this->get('keepLogged')){
                    setcookie(session_name(), session_id(), time()+$this->holdtime, "/");
		}
		else{
                    setcookie(session_name(), session_id(), 0, "/");
		}

	}

}