<?php
class UserAction extends CustomAction {
    public function index(){
    	$UserModel = D("User");
    	$UserName = session("username");
    	$user = $UserModel->where("UserName='$username'")->find();
    	if(!$user){
    		$this->redirect("/User/login");
    	}
		$this->display();
    }

    public function save(){
    	$this->display();
    }

    public function login(){
    	if(IS_POST){
    		$UserModel = D("User");
    		$userName = $_POST['userName'];
    		$password = $_POST['password'];
    		$user = $UserModel->where("UserName='$userName'")->find();
    		if($user){
    			if($user['password'] == md5($password)){
    				$this->continueUrl();
    			}else{
    				//print errors
    			}
    		}else{
    			//print errors
    		}
    	}

		$this->display();
    }

    public function logout(){
    	session("username",null);
		$this->redirect("/User/login");
    }

    public function register(){
    	if(IS_POST){
    		$UserModel = D("User");
    		$user = $UserModel->create();
    		if($user){
    			if($user->save()){
    				$this->continueUrl();
    			}else{
    				//print errors
    			}
    		}else{
    			//print errors
    		}
    	}

		$this->display();
    }
}