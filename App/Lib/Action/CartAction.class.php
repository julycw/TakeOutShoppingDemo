<?php
class CartAction extends CustomAction {
    protected $actionName = "购物车";
    public function index(){
    	$this->display();
    }

    public function getDetails(){
    	if(session('userName')){
			$userName = session('userName');
			$CartModel = D('Cart');
			$cart = $CartModel->where("userName='$userName'")->relation(true)->select();
		}else{
			$cart = json_decode(cookie("cart"),true);
		}
		$this->ajaxReturn($cart,"JSON");
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
	    			}else{
	    			}
	    		}else{
	    			$_POST['userName'] = session('userName');
	    			$_POST['productId'] = $id;
	    			$_POST['quantity'] = $quantity;
	    			if($CartModel->create() && $CartModel->add()){
	    			}else{
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
	    			$product['productId'] = $id;
	    			$product['quantity'] = $quantity;
	    			$product['product']['unitPrice'] = $product['unitPrice'];
	    			$product['product']['productName'] = $product['productName'];
		    		$productList[] = $product;
	    		}
	    		cookie('cart',json_encode($productList));
	    	}
    	}
    	$this->getDetails();
    }

    public function checkOut(){
    	if(IS_POST){
    		if(!session("userName")){
				$this->needLogin();
	    	}else{
	    		$userName = session('userName');
				$orderNumber = time().'_'.mt_rand(1000,9999); //时间戳+4位随机数
				$address = $_POST['address'];
				$phone = $_POST['phone'];
				$createOn = date('Y-m-d H:i:s',time());
				$price = 0;

	    		$newOrder = array();

				$CartModel = D('Cart');
				$cart = $CartModel->where("userName='$userName'")->relation(true)->select();
				foreach ($cart as $value) {
					$price += $value['product']['unitPrice'] * $value['quantity'];
					$newOrder['orderDetails'][] = array(
						'orderNumber' => $orderNumber,
				        'productId' => $value['productId'],
				        'productName' => $value['product']['productName'],
				        'unitPrice' => $value['product']['unitPrice'],
				        'quantity' => $value['quantity']
					);
				}

	    		$newOrder['userName'] = $userName;
	    		$newOrder['orderNumber'] = $orderNumber;
	    		$newOrder['address'] = $address;
	    		$newOrder['phone'] = $phone;
	    		$newOrder['price'] = $price;
	    		$newOrder['createOn'] = $createOn;

				if(D('Order')->relation(true)->add($newOrder)){
					$this->clear();
					redirect(__APP__."/Order");
				}

	    	}
    	}else{
			redirect(__APP__."/Shop");  		
    	}
    }

    public function clear(){
		D("Cart")->where("userName='".session('userName')."'")->delete();
		cookie('cart',null);
    }
}