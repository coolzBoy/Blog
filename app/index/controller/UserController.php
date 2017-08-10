<?php

namespace index\controller;
use cz\framework\VerifyCode;//引入验证码类
use cz\framework\Upload;//引入上传文件类
use index\model\UserModel;
use index\model\Blog;

class UserController extends BaseController
{
	protected $user;//用户model
	protected $upload;//上传文件model
	protected $blog;//博客model


	//通过初始化生成相应的model对象
	public function _init()
	{
		$this->user = new UserModel();
		$this->blog = new Blog();
		$this->upload = new Upload(['uploadDir' =>'public/upload']);
		// var_dump($this->user);die;
	}

	//生成登录页面
	public function login()
	{
		$this->display();
	}
	//生成注册页面
	public function register()
	{
		$this->display();
	}
	//加载个人中心页面
	public function person()
	{
		$name = $_SESSION['user'];
		$u = $this->user->getByUsername($name)[0];
		$this->assign('u',$u);
		//某一个用户发表的所有博客
		$wen = $this->blog->userBlog($name);
		
		$this->assign('wen',$wen);

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
	//检查用户登录
	public function checkLogin()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(strcmp($_SESSION['code'],$_POST['code'])){
			$this->error('验证码不正确！');
		}else{
			$result = $this->user->checkUser($username);
			if(!$result){
				$this->error('该用户名不存在！');
			}else{
				$result = $this->user->checkPwd($username,$password);
				if(!$result){
					$this->error('密码不正确！');
				}else{
					$_SESSION['user'] = $username;
					$this->success('登录成功！','index.php');
				}				
				}
			}
	}
	//检查用户注册
	public function checkRegister()
	{
		$username = $_POST['username'];
		$pwd = $_POST['pwd'];
		$rpwd = $_POST['rpwd'];

		if(strcmp($_SESSION['code'],$_POST['code'])){
			$this->error('验证码不正确！');
		}else{
			$result = $this->user->checkUser($username);
			if($result){
				$this->error('该用户名已被注册！');
			}else{

				if(strcmp($pwd,$rpwd)){
					$this->error('两次密码输入不一致！');
				}else{
					//向数据库插入该用户
					$result1 = $this->user->insertUser($username,$pwd);
					if($result1){
						$_SESSION['user'] = $username;
						$this->success('注册成功，3秒后自动登录到首页！','index.php');
					}else{
						$this->error('注册失败！');
					}				
				}				
				}
			}
	}
	//用户头像设置
	public function deal_touxiang()
	{
		
		if($_FILES['touxiang']['error'] != 0){
			$this->error('上传文件失败！！！');
		}else{
			$path = $this->upload->upload('touxiang');
			$u = $_POST['u'];
			// var_dump($u,$path);exit;
			$result = $this->user->updateTou($u,$path);
			if($result){
				$this->success('保存用户头像成功！');
			}else{
				$this->error('保存用户头像失败！');
			}
		}
		
	}

}