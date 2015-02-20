<?php
	function get_url() {
	    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
	    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
	    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}

	class Pagination{
		var $currIndex;
		var $pageSize;
		var $pageNum;
		var $pageListNum;
		var $pages;
		var $firstRow;
		var $listRows;
		var $totalCount;
		public function __construct($itemCount,$pageSize,$pageIndex,$pageListNum){
			$this->pageSize = $pageSize;
			$this->listRows = $pageSize;
			$this->totalCount = $itemCount;
			if($pageListNum > 0){
				$this->pageListNum = $pageListNum;
			}else{
				$this->pageListNum = 4;
			}
			$this->pageNum = floor(($itemCount - 1)/$pageSize) + 1; //总页数

			$this->setPageIndex($pageIndex);
		}

		public function setPageIndex($pageIndex){
			if ($pageIndex > $this->pageNum){
				$pageIndex = $this->pageNum;
			}
			if($pageIndex == "" || $pageIndex < 1){
				$pageIndex = 1;
			}

			$this->firstRow = ($pageIndex-1) * $this->pageSize;
			$this->currIndex = $pageIndex;
			$this->makePages();
		}

		public function getPageIndex(){
			return $this->currIndex;
		}

		public function getPageNum(){
			return $this->pageNum;
		}

		public function getPages(){
			return $this->pages;
		}

		public function getPageInfo(){
			$info['totalCount'] = $this->totalCount;
			$info['pageIndex'] = $this->currIndex;
			$info['pageNum'] = $this->pageNum;
			$info['pages'] =$this->pages;
			$info['pageSize'] = $this->pageSize;
			if($this->currIndex < $this->pageNum){
				$info['hasNext'] = "yes";
				$info['nextPage'] = $this->currIndex +1;
			}
			if($this->currIndex >1){
				$info['hasPrev'] = "yes";
				$info['prevPage'] = $this->currIndex -1;
			}
			return $info;
		}

		private function makePages(){
			$pages = array();
			if($this->pageListNum *2 +1 > $this->pageNum){
				$this->pageListNum = floor($this->pageNum /2);
			}
			$pageIndexBegin = $this->currIndex - $this->pageListNum;
			if($this->currIndex + $this->pageListNum > $this->pageNum){
				$pageIndexBegin = $pageIndexBegin - ($this->currIndex + $this->pageListNum - $this->pageNum);
			}
			if($pageIndexBegin <= 0){
				$pageIndexBegin = 1;
			}

			for ($i=0; $i < $this->pageListNum*2+1; $i++) {
				$pages[$i] = $i+$pageIndexBegin;
				if($i+$pageIndexBegin == $this->pageNum){
					break;
				}
			}

			$this->pages = $pages;
		}
	}
?>