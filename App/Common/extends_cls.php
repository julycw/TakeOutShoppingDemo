<?php
class CustomAction extends Action{
	protected $tips;

	public function _initialize(){
		$this->tips = array();
		if(session('userName') != ""){
			$this->assign('userName',session('userName'));
			$this->assign('nickName',session('nickName'));
			$this->assign('isLogined',"true");
		}
	}

	public function continueUrl($redirect){
		$redirect = $redirect?$redirect:"redirect";
		$redirect_url = $_GET[$redirect]?$_GET[$redirect]:$_POST[$redirect];
		$redirect_url = $redirect_url?$redirect_url:"/";
		$this->redirect($redirect_url);
	}

	public function addTip($msg,$level){
		if(!$level){
			$level = "info";
		}
		$this->tips[] = ["msg"=>$msg,"level"=>$level];
	}

	public function display($action,$charset,$format){
		$this->assign("tips",$this->tips);
		return parent::display($action,$charset,$format);
	}
}
?>