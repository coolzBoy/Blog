<?php

namespace admin\model;
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
	//检查管理员输入的密码是否正确
	public function checkPwd($name,$pwd)
	{
		$pwd = md5($pwd);
		$data = $this->where("username= '$name'")->select(MYSQLI_ASSOC)[0];
		if(strcmp($pwd, $data['password'])){
			return false;
		}
		return true;
	}
	//修改密码
	public function updatePwd($user,$pwd)
	{
		$pwd = md5($pwd);
		$data['password'] = $pwd;
		return $this->where("username='$user'")->update($data);

	}


	
}