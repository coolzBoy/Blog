<?php

namespace cz\framework;

class Page
{
	public $total = 1;//总记录数
	public $perpage = 5;//每页记录数
	public $totalPage;//总页数
	public $curPage;//当前页
	public $url;

	/**
	 * 初始化对象
	 *
	 * @param      integer  $total  总记录数
	 * @param      integer  $count  每页记录数
	 */
	public function __construct($total,$count)
	{
		$this->total=$total<2?$this->total:$total;
		$this->perpage = $count<1?$this->perpage:$count;
		$this->totalPage = ceil($this->total/$this->perpage);
		$this->getPage();//获取当前页

		$this->url = $this->getUrl();//url不带page参数

	}

	/**
	 * 返回第一页的url
	 * @return [type] [description]
	 */
	public function first()
	{
		return $this->setUrl(1);
	}
	/**
	 * 返回最后一页的url
	 * @return [type] [description]
	 */
	public function last()
	{
		return $this->setUrl($this->totalPage);
	}
	/**
	 * 返回上一页的url
	 * @return function [description]
	 */
	public function pre()
	{
		if($this->curPage - 1 <= 1){
			return $this->setUrl(1);
		}
		return $this->setUrl($this->curPage - 1);	
	}

	/**
	 * 返回下一页的url
	 * @return function [description]
	 */
	public function next()
	{
		if($this->curPage + 1 >=$this->totalPage){
			return $this->setUrl($this->totalPage);
		}
		return $this->setUrl($this->curPage + 1);
	}
	/**
	 * 跳转指定页
	 * @return [type] [description]
	 */
	public function jumpPage($page)
	{
		if ($page<1 || $page>$this->totalPage) {
			return $this->setUrl($this->curPage);
		}
		return $this->setUrl($page);
	} 
	/**
	 * 获取分页的偏移量
	 * @return [type] [description]
	 */
	public function limit()
	{
		$offset = ($this->curPage-1)*$this->perpage;
		return ' '.$offset.','.$this->perpage;
	}
	/**
	 * 返回所有页的url
	 * @return [type] [description]
	 */
	public function allPage()
	{
		return [
		'first' => $this->first(),
		'pre'=> $this->pre(),
		'next' => $this->next(),
		'last' => $this->last()
		];
	}
	/**
	 * 拼接为带参数的url
	 * @param [type] $page [description]
	 */
	/*protected function setUrl($page){
		return $this->url.'?page='.$page;
	}*/
	protected function setUrl($page)
	{
		//判断url中是否有？
		//http://localhost/1707/hight/5/Page.php?page=1
		if (stripos($this->url,'?')) {
			return $this->url . "&page=".$page;
		} else {
			return $this->url . "?page=".$page;
		}
	}
	/**
	 * 获取不带参数的url
	 * @return [type] [description]
	 */
	/*protected function getUrl()
	{
		$url = $_SERVER['REQUEST_SCHEME'];
		$url = $url.'://'.$_SERVER['SERVER_NAME'];
		$url.=$_SERVER['SCRIPT_NAME'];
		return $url;
	} */

	protected function getUrl()
	{
		$url = $_SERVER['REQUEST_SCHEME'] .'://';//获取协议
		$url .= $_SERVER['HTTP_HOST']; //拼接主机地址
		$url .= ':' . $_SERVER['SERVER_PORT'];//拼接端口                    
		$data = parse_url($_SERVER['REQUEST_URI']);
		$url .= $data['path'];//拼接路径
		if (!empty($data['query'])) {
			parse_str($data['query'],$paras);//获取查询参数，然后放到$paras数组中
			unset($paras['page']);//销毁page元素
			$url .= '?' . http_build_query($paras);        
			
		}
		$url = rtrim($url,'?');//干掉最后一个问号
		return $url;                                           
	}

	/**
	 * 获取当前页码
	 * @return [type] [description]
	 */
	protected function getPage()
	{
		if(empty($_GET['page'])){
			$this->curPage = 1;
		}else{
			if ($_GET['page']<2) {
				$this->curPage = 1;
			}else if($_GET['page']>$this->totalPage){
				$this->curPage = $this->totalPage;
			}else{
				$this->curPage = $_GET['page'];
			}
		}

	}

}