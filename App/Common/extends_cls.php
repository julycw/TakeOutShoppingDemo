<?php
class BaseAction extends Action{
	protected $actionName;
	protected $tips;
	protected $breadcrumb;

	public function _initialize(){
		if(session('userName') != ""){
			$this->assign('userName',session('userName'));
			$this->assign('nickName',session('nickName'));
			$this->assign('isLogined',"true");
		}

		if($this->actionName){
			$this->addBreadcrumb($this->actionName,MODULE_NAME);
		}
	}

	protected function addBreadcrumb($title,$href){
		$this->breadcrumb[] = array("href"=>"/$href","title"=>$title);
	}

	public function continueUrl($redirect){
		$redirect = $redirect?$redirect:"redirect";
		$redirect_url = $_GET[$redirect]?$_GET[$redirect]:$_POST[$redirect];
		$redirect_url = $redirect_url?$redirect_url:__APP__;
		redirect($redirect_url);
	}

	public function addTip($msg,$level){
		if(!$level){
			$level = "info";
		}
		$this->tips[] = ["msg"=>$msg,"level"=>$level];
	}

	public function display($action,$charset,$format){
		$this->assign("tips",$this->tips);
		$this->tips = array();
		$this->assign('breadcrumb',$this->breadcrumb);
		$this->breadcrumb = array();
		return parent::display($action,$charset,$format);
	}

	public function needLogin(){
		$url = get_url();
		redirect(__APP__."/User/login.html?redirect=$url");
	}
}

class CustomAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
	}
}

class AdmAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
		if(session("role") !== "admin"){
			$this->needLogin();
		}
	}

	public function handleModel($model){
    	$ThisModel = D($model);
    	$count = $ThisModel->count();
    	$pageSize = 20;
    	$pageIndex = $_GET['page']?$_GET['page']:1;
    	$pagenation = new Pagination($count,$pageSize,$pageIndex);
		$data = $ThisModel->order("ID desc")->limit($pagenation->firstRow.','.$pagenation->listRows)->relation(true)->select();
		$this->assign("pageInfo", $pagenation->getPageInfo());
		$this->assign("list", $data);
		$this->assign("page",$pageIndex);
    	$this->display();
	}
}
function handleModelAdd($model){
	$ThisModel = D($model);
	if($ThisModel->create()){
		if($ThisModel->add()){
			return true;
		}
	}
	return false;
}

function handleModelModify($model){
	$ThisModel = D($model);
	if($ThisModel->create()){
		if($ThisModel->save()){
			return true;
		}
	}
	return false;
}

function handleModelDelete($model){
	$ThisModel = D($model);
	$id = $_POST['id'];
	if($ThisModel->relation(true)->delete($id)){
		return true;
	}
	return false;
}
?>