<?php
class CustomAction extends Action{
	public function _initialize(){
		
	}

	public function continueUrl($redirect){
		$redirect = $redirect?$redirect:"redirect";
		$redirect_url = $_GET[$redirect]?$_GET[$redirect]:$_POST[$redirect];
		$redirect_url = $redirect_url?$redirect_url:"/";
		$this->redirect($redirect_url);
	}
}
?>