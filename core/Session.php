<?php
class Session{

	// function __construct(){
		
	// }

	public static function start(){
		$sess_name = 'secure_session_id';
		$httponly = true; // Celà empechera le javascript d'acceder à la session
		$secure = false; // true si on utilise de https

		ini_set('session.use_only_cookies', 1); //forces sessions only use cookies
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
		session_name($sess_name);
		session_start(); //start php session
		session_regenerate_id(); //regenerated session, delete the old one
		session_id();
	}


	public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key)
    {
        if (isset($_SESSION[$key]))
        	return $_SESSION[$key];
    }
    
    public static function destroy()
    {
    	if( !isset($_SESSION) ) {
    		self::start();
    	}

        //unset($_SESSION);
        $_SESSION = array();

        $params = session_get_cookie_params();
       
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

        session_destroy(); //destroy session
    }


    public static function getRule( $org ){
    	$orgs = Session::get('orgs');
    	if(isset($orgs[$org]))
    		return $orgs[$org]['rule'];
    	else
    		redirect('errors/404');
    }

    public static function getRuleOrgid( $org ){
    	$orgs = Session::get('orgs');
    	if(isset($orgs[$org]))
    		return $orgs[$org]['orgid'];
    	else
    		redirect('errors/404');
    		
    }


    //Verify that the current user is really on database
    //$c controllers
    public static function verifyLogin($c){

    	if( !isset($_SESSION) ){
    		Session::start();
    	}

    	if(Session::get('uid')==null ){
    		return false;
    	}

    	$c->loadModel('User');
    	$users = $c->User->find(array(
    		'fields' => 'password' ,
    		'conditions' => array('uuid' => Session::get('uid'))
    		));

    	
    	if(!$users){
    		return false;
    	}else{
    		$user = $users[0];
    	}

    	if(Session::get('log_hash') == hash('sha1', $user->password.$_SERVER['HTTP_USER_AGENT'])){
    		return true;
    	}else{
    		redirect('error/404');
    	}

	   //tu oublie que Session n'est pas un controller,
	   //donc $this equivaut à la classe Session
	   //depuis la premiere ligne il y'a un blem , ta condition sera toujours fausse donc toujours rediriger vers la page 
	   //d'acceuil	
	   // 		if(Session::get('uid') AND Session::get('username') AND Session::get('log_hash')){ //verify if all session variables are set
	   			
	   // 			$userbrowser = $_SERVER['HTTP_USER_AGENT'];
	   			

	   // 			$this->loadModel('User');
					
				// $users = $this->User->find(array(
				// 		'fields' => array('password'),
				// 		'conditions' => array('uuid'=>Session::get('user_id')) 
				// 		));

				// //$passwd = $users[0];
				// debug($user);

				// //$logcheck = hash('sha1', $passwd.$userbrowser);

				// // if ($logcheck = Session::get('logstring')) {
				// // 	die('logged In');
				// // }else{
				// // 	header("Location: ".BUSITICKA);
				// // 	// return false; //loggin failed
				// // }


	   // 		}else{
	   // 			 header("Location: ".BUSITICKA);
	   // 			// return false; //loggin failed
	   // 		}
	}
   		




	//Show some message error

	public function setflash($message,$type='success'){

		$_SESSION['flash'] = array(
			'message'=> $message,
			'type'   => $type
		);
	}

	public function flash(){
		if(isset($_SESSION['flash']['message'])){
			$html = '<div class="alert-message '.$_SESSION['flash']['type'].'"><p>'.$_SESSION['flash']['message'].'</p></div>';
			$_SESSION['flash'] = array();
			return $html;
		}
		
	}

}

?>