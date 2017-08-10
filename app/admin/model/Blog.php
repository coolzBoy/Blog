<?php

namespace admin\model;
use cz\framework\Model;
use cz\framework\Page;

class Blog extends Model
{
	
	//遍历出博客列表中所有的博客
	public function blogAll()
	{
		return $this->where('rid=0')->select(MYSQLI_ASSOC);

	}
	//按分页遍历出博客列表中所有的博客
	public function blogList()
	{
		$result1 = $this->where('rid=0')->select(MYSQLI_ASSOC);
		$total = count($result1);
		$pge = new Page($total,5);
		$limit = $pge->limit();

		$result2 = $this->where('rid=0')->limit($limit)->order('bid desc')->select(MYSQLI_ASSOC);
		return [$pge,$result2];
	}
	//按分页遍历出评论列表中所有的评论
	public function commentList()
	{
		$result1 = $this->where('rid>0')->select(MYSQLI_ASSOC);
		$total = count($result1);
		$pge = new Page($total,6);
		$limit = $pge->limit();

		$result2 = $this->where('rid>0')->limit($limit)->order('bid desc')->select(MYSQLI_ASSOC);
		return [$pge,$result2];
	}

	//删除选中的评论
	public function delComment(array $arr)
	{
		foreach ($arr as $v) {
			//修改该评论对应的博客的评论数
			$dt = $this->where("bid=$v")->select(MYSQLI_ASSOC)[0];
			$rid = $dt['rid'];
			$da = $this->where("bid=$rid")->select(MYSQLI_ASSOC)[0];
			$data['replys'] = $da['replys']-1;
			$this->where("bid=$rid")->update($data);
			//删除该条评论
			$result = $this->where("bid=$v")->delete();
			if(!$result){
				return false;
			}
		}
		return true;	
	}

	//删除选中的文章
	public function delContent(array $arr)
	{
		foreach ($arr as $v) {
			$result = $this->where("bid=$v")->delete();
			if(!$result){
				return false;
			}
		}
		return true;	
	}
	
	//遍历出某条博客下对应的所有的评论，按降序排
	public function blogComment($id)
	{
		$result1 = $this->where("rid=$id")->select(MYSQLI_ASSOC);
		$total = count($result1);

		$pge = new Page($total,2);
		$limit = $pge->limit();
		$result2 = $this->where("rid=$id")->order('bid desc')->limit($limit)->select(MYSQLI_ASSOC);
		return [$pge,$result2];

		
	}

	//向博客列表中插入新发表的博客
	public function insertBlog(array $arr)
	{
		$data['title'] = $arr['title'];
		$data['author'] = $arr['author'];
		$data['content'] = $arr['content'];
		$data['rid'] = 0;
		return $this->insert($data,true);
	}
	//修改博客列表中某一条博客
	public function updateBlog(array $arr)
	{
		$bid =(int)$arr['id'];
		$data['title'] = $arr['title'];
		$data['content'] = $arr['content'];

		return $this->where("bid=$bid")->update($data);
	}
		
	//某个用户发表的所有博客
	public function userBlog($name)
	{
		return $this->where("author='$name' and rid=0")->order('bid desc')->select(MYSQLI_ASSOC);
	}


}