<?php

namespace index\controller;

use index\model\UserModel;
use index\model\Blog;

class IndexController extends BaseController
{

	protected $user;//用户model
	protected $blog;//博客内容model


	public function _init()
	{
		$this->user = new UserModel();
		$this->blog = new Blog();
	}

	public function index()
	{
		//找出用户列表中所有的用户
		$allUser = $this->user->userList();
		$this->assign('allUser',$allUser);

		if(empty($_GET['page']))
		{
			$p=1;
		}else{
			$p =(int)$_GET['page'];
		}
 
		$result = $this->blog->blogList();
		$obj = $result[0];
		$title = $result[1];
		
		$arr = $obj->allPage();
		// var_dump($arr);exit;
		$curPage = $obj->curPage; 
		$totalPage = $obj->totalPage; 
		
		//向html页面传送所有的博客标题变量
		$this->assign('title',$title);

		//向html页面传送分页变量
		$this->assign('p',$p);
		$this->assign('arr',$arr);
		$this->assign('curPage',$curPage);
		$this->assign('totalPage',$totalPage);

		//加载首页
		$this->display();
	}

	public function gallery()
	{
		$this->display();
	}

	
}