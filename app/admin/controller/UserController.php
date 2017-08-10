<?php

namespace admin\controller;
use cz\framework\VerifyCode;//引入验证码类
use cz\framework\Upload;//引入上传文件类
use admin\model\UserModel;
use admin\model\Blog;

class UserController extends BaseController
{
	protected $user;//用户model
	/*protected $blog;//博客model*/


	//通过初始化生成相应的model对象
	public function _init()
	{
		$this->user = new UserModel();
		/*$this->blog = new Blog();*/
	}

	//生成登录页面
	public function login()
	{
		$this->display();
	}
	//生成修改密码页面
	public function pwdSet()
	{
		$this->display();
	}

	//生成验证码
	public function code()
	{
		$code = new VerifyCode();
		$code->outputCode();
		
		$_SESSION['code'] = $code->getCode();

	}
	//退出操作
	public function exit()
	{
		$_SESSION = [];
		session_destroy();
		$this->success('退出成功！！','index.php');
	}
	//检查是否是管理员登录
	public function checkLogin()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(strcmp($_SESSION['code'],$_POST['code'])){
			$this->error('验证码不正确！');
		}else{
			 if($username !== 'admin'){
				$this->error('管理员账号名不正确');
			}else{
				$result = $this->user->checkPwd($username,$password);
				if(!$result){
					$this->error('密码不正确！');
				}else{
					$_SESSION['admin'] = $username;
					$this->success('登录成功！','index.php?m=admin');
				}				
				}
			}
	}

	//修改管理员密码
	public function adminPwd()
	{
		$pwd = $_POST['pass'];
		$result = $this->user->checkPwd('admin',$pwd);
		if(!$result){
			$this->error('原密码不正确！！');
		}else{
			$newPwd = $_POST['newpass'];
			$result = $this->user->updatePwd('admin',$newPwd);
			if($result)
			{
				$this->success('修改新密码成功！！');
			}else{
				$this->error('修改新密码失败！！');
			}
			
		}
	}
	
	
}