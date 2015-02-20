<?php
class OrderAction extends CustomAction {
    protected $actionName = "我的订单";
    public function index(){
        if(!session('userName')){
            $this->needLogin();
        }
        $userName = session('userName');
        $OrderModel = D('Order');
        $pageSize = 50;
        $pageIndex = $_GET['page']?$_GET['page']:1;
        $count = $OrderModel->where("userName='$userName'")->count();
        
        $pagenation = new Pagination($count,$pageSize,$pageIndex);
        $orders = $OrderModel->where("userName='$userName'")->limit($pagenation->firstRow.','.$pagenation->listRows)->order("createOn desc")->relation(true)->select();
        $this->assign("orders",$orders);
        $this->assign("pageInfo", $pagenation->getPageInfo());
        $this->assign("page",$pageIndex);
        $this->display();
    }
}