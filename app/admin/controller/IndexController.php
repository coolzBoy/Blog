<?php

namespace admin\controller;

use admin\model\UserModel;
use admin\model\Blog;

class IndexController extends BaseController
{

	protected $user;//用户model
	protected $blog;//博客内容model


	public function _init()
	{
		$this->user = new UserModel();
		$this->blog = new Blog();
	}

	//加载后台首页
	public function index()
	{
		if(empty($_SESSION['admin']))
		{
			$this->error('非管理员登录！！禁止访问！！！','index.php');
		}else{

			$this->display();
		}
		
	}
	
	/*//加载网站信息页面
	public function zhan()
	{
		$this->display();
	}*/

}