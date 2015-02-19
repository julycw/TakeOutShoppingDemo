<?php
class AdminAction extends AdmAction {
    public function index(){
    	$this->display();
    }

    public function user(){
    	$this->handleModel("User");
    }
    public function userAdd(){
    	handleModelAdd("User");
        $this->redirect("Admin/user");
    }
    public function userModify(){
    	handleModelModify("User");
        $this->redirect("Admin/user");
    }
    public function userDelete(){
    	handleModelDelete("User");
        $this->redirect("Admin/user");
    }

    public function product(){
        $CategoryModel = D("Category");
        $this->assign("categories",$CategoryModel->select());
    	$this->handleModel("Product");
    }
    public function productAdd(){
        $fileName = time().'_'.mt_rand();
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->key = "image";
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Public/uploads/';// 设置附件上传目录
        $upload->saveRule = $fileName;
        if($upload->upload()){
            $info = $upload->getUploadFileInfo();
            $_POST['imageUrl'] = "/uploads/".$info[0]['savename'];
            handleModelAdd("Product");
        }

        $this->redirect("Admin/product");
    }
    public function productModify(){
    	handleModelModify("Product");
        $this->redirect("Admin/product");
    }
    public function productDelete(){
    	handleModelDelete("Product");
        $this->redirect("Admin/product");
    }

    public function category(){
    	$this->handleModel("Category");
    }
    public function categoryAdd(){
    	handleModelAdd("Category");
        $this->redirect("Admin/category");
    }
    public function categoryModify(){
    	handleModelModify("Category");
        $this->redirect("Admin/category");
    }
    public function categoryDelete(){
    	handleModelDelete("Category");
        $this->redirect("Admin/category");
    }

    public function order(){
    	$this->handleModel("Order");
    }
    public function orderAdd(){
    	handleModelAdd("Order");
        $this->redirect("Admin/order");
    }
    public function orderModify(){
    	handleModelModify("Order");
        $this->redirect("Admin/order");
    }
    public function orderDelete(){
    	handleModelDelete("Order");
        $this->redirect("Admin/order");
    }

    public function statistic(){
    	$this->display();
    }
}