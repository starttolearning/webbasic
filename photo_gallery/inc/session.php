<?php

class Session
{

    private $logged_in = false;
    public $user_id;
    public $message;

    function __construct()
    {
        session_start();
        $this->check_message();
        $this->check_login();
    }

    public function is_logged_in()
    {
        return $this->logged_in;
    }

    public function login($user)
    {
        if ($user) {
            $this->user_id = $_SESSION["user_id"] = $user->id;
            $this->logged_in = true;
        }
    }

    public function logout()
    {
        unset($this->user_id);
        unset($_SESSION['user_id']);
        $this->logged_in = false;
    }

    public function message( $msg =""){
      if( ! empty( $msg ) ){
        // then this is 'set' message
        // make sure you understand why $this->message = $msg wouldn't work
        $_SESSION['message']  = $msg;
      }else {
        // then this is the  get message
          return $this->message;
      }
    }

    private function check_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION["user_id"];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }

    private function check_message(){
      // Is there a message stored in the message
      if( isset( $_SESSION['message'] ) ){
        // Add it as an attribute and erase the stored version
        $this->message  = $_SESSION['message'];
        unset( $_SESSION['message'] );
      }else {
        $this->message = "";
      }
    }
}

$session = new Session();
$message = $session->message();