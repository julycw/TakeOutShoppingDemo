<?php
class CartAction extends CustomAction {
    public function index(){
    	$this->display();
    }

    public function putIn(){
    	$id = $_POST['productId'];
    	$quantity = $_POST['quantity']?$_POST['quantity']:1;
    	$ProductModel = D("Product");
    	$product = $ProductModel->find($id);
    	if($product){
    		//已登录用户，将数据存入数据库
	    	if(session("userName")){
	    		$CartModel = D("Cart");
	    		$item = $CartModel->where("userName='".session('userName')."' and productId=$id")->find();
	    		if($item){
	    			$item['quantity'] += $quantity;
	    			if($CartModel->data($item)->save()){
	    				$return['code'] = '0';
	    			}else{
	    				$return['code'] = '1';
	    			}
	    		}else{
	    			$_POST['userName'] = session('userName');
	    			$_POST['productId'] = $id;
	    			$_POST['quantity'] = $quantity;
	    			if($CartModel->create() && $CartModel->add()){
	    				$return['code'] = '0';
	    			}else{
	    				$return['code'] = '1';
	    			}
	    		}
	    	}else{ // 未登录用户，将数据暂存cookies中，登录后转移到数据库
	    		if(cookie('cart')){
	    			$productList = json_decode(cookie('cart'),true);
	    		}else{
	    			$productList = array();
	    		}

	    		$isFound = false;
	    		foreach ($productList as $key => & $value) {
	    			if($value['productId'] == $id){
	    				$value['quantity'] += $quantity;
	    				$isFound = true;
	    				break;
	    			}
	    		}
	    		if(!$isFound){
		    		$productList[] = ['productId'=>$id,'quantity'=>$quantity];
	    		}
	    		cookie('cart',json_encode($productList));
				$return['code'] = '0';
	    	}
    	}
    	
    	$this->ajaxReturn($return,"JSON");
    }

    public function putOut(){
    	$id = $_POST['productId'];
    	$quantity = $_POST['quantity'];
    	if(session("userName")){
    		$ProductModel = D("Product");
    		if($ProductModel->delete($id)){

	    	}else{ 

	    	}
    	}else{

    	}
    	
    	$this->ajaxReturn($product,"JSON");
    }
}