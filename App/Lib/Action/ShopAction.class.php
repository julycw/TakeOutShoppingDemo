<?php
class ShopAction extends CustomAction {
    protected $actionName = "点餐";
    public function index(){
    	$CategoryModel = D('Category');
    	$ProductModel = D('Product');
    	
        $categories = $CategoryModel->select();
    	$this->assign("categories",$categories);

    	$categoryId = $_GET['category'];
    	if($categoryId){
            foreach ($categories as $value) {
                if($value['id'] === $categoryId){
                    $categoryName = $value['categoryName'];
                    break;
                }
            }
            $this->addBreadcrumb($categoryName,MODULE_NAME."?category=$categoryId");
	    	$this->assign("products",$ProductModel->where("categoryId='$categoryId'")->select());
    	}else{
	    	$this->assign("products",$ProductModel->select());
    	}

    	$this->display();
    }
}