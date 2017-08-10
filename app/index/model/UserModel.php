<?php

namespace index\model;
use cz\framework\Model;

class UserModel extends Model
{
	//遍历整个用户表
	public function userList()
	{
		return $this->select(MYSQLI_ASSOC);
	}
	//检查用户是否存在
	public function checkUser($name)
	{
		return $this->where("username= '$name'")->select(MYSQLI_ASSOC);
	}
	//检查密码是否正确
	public function checkPwd($name,$pwd)
	{
		$pwd = md5($pwd);
		$data = $this->where("username= '$name'")->select(MYSQLI_ASSOC)[0];
		if(strcmp($pwd, $data['password'])){
			return false;
		}
		return true;
	}

	//插入新注册的用户
	public function insertUser($user,$pwd)
	{
		$pwd = md5($pwd);
		return $this->insert(['username'=>$user,'password'=>$pwd]);

	}
	//修改用户头像
	public function updateTou($user,$path)
	{
		$data['touxiang'] = $path;
		return $this->where("username='$user'")->update($data);
	}

	
}