<?php

class Base{
    public function __construct()
    {
        session_start();

        $this->user=isset($_SESSION['user'])?$_SESSION['user']:false;
        /*if(!$this->user){
            header('location:/Home/index');
            exit();
        }*/
    }
    protected function load(){
    }

}