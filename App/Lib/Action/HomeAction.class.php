<?php
class HomeAction extends CustomAction {
    public function index(){
    	$this->display();
    }

    public function about(){
		$this->addBreadcrumb("关于",MODULE_NAME.'/'.ACTION_NAME);
    	$this->display();
    }
}