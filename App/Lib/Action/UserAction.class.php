<?php
class UserAction extends CustomAction {
    public function index(){
    	$UserModel = D("User");
    	$UserName = session("userName");
    	$user = $UserModel->where("userName='$UserName'")->find();
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
                    session("userName",$user['userName']);
                    session("nickName",$user['nickName']);
                    session("role",$user['role']);
                    $this->actionOnLogin();
    				$this->continueUrl();
    			}else{
                    $this->addTip("密码错误");
    			}
    		}else{
                $this->addTip("未找到该用户");
    		}
    	}

		$this->display();
    }

    public function logout(){
        session("userName",null);
        session("nickName",null);
        session("role",null);
		$this->redirect("/User/login");
    }

    public function register(){
    	if(IS_POST){
    		$UserModel = D("User");
            $_POST['role'] = 1;
            $_POST['password'] = md5($_POST['password']);
    		$user = $UserModel->create();
    		if($user){
                $user['nickName'] = $user['nickName']?$user['nickName']:$user['userName'];
    			if($UserModel->add()){
                    session("userName",$user['userName']);
                    session("nickName",$user['nickName']);
                    session("role",$user['role']);
                    $this->actionOnLogin();
    				$this->continueUrl();
    			}else{
                    $this->addTip($UserModel->getError());
    			}
    		}else{
                $this->addTip("信息错误");
    		}
    	}

		$this->display();
    }

    private function actionOnLogin(){
        if(cookie('cart')){
            $CartModel = D("Cart");

            $productList = json_decode(cookie('cart'),true);
            foreach ($productList as $value) {
                $item = $CartModel->where("userName='".session('userName')."' and productId=".$value['productId'])->find();
                if($item){
                    $item['quantity'] += $value['quantity'];
                    $CartModel->data($item)->save();
                }else{
                    $item['userName'] = session('userName');
                    $item['quantity'] = $value['quantity'];
                    $item['productId'] = $value['productId'];
                    $CartModel->data($item)->add();
                }
            }
            cookie('cart',null);
        }
    }
}