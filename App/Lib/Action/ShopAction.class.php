<?php
class ShopAction extends CustomAction {
    public function index(){
    	$CategoryModel = D('Category');
    	$ProductModel = D('Product');
    	
    	$this->assign("categories",$CategoryModel->select());

    	$categoryCode = $_GET['category'];
    	if($categoryCode){
	    	$this->assign("products",$ProductModel->where("categoryCode='$categoryCode'")->select());
    	}else{
	    	$this->assign("products",$ProductModel->select());
    	}

    	$this->display();
    }
}