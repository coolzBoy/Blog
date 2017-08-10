<?php

namespace index\model;
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
		$pge = new Page($total,3);
		$limit = $pge->limit();

		$result2 = $this->where('rid=0')->limit($limit)->select(MYSQLI_ASSOC);
		return [$pge,$result2];
	}
	//遍历出最新发表的博客
	public function newBlog()
	{
		return $this->where('rid=0')->order('bid desc')->limit('6')->select(MYSQLI_ASSOC);
	}
	//遍历出最近发表的评论
	public function newComment()
	{
		return $this->where('rid>0')->order('bid desc')->limit('3')->select(MYSQLI_ASSOC);
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

	//向博客表中插入新发表的评论
	public function insertComment(array $arr)
	{
		$data['author'] = $arr['author'];
		$data['content'] = $arr['comment'];
		$data['rid'] = $arr['bid'];
		return $this->insert($data);
	}
	//某个用户发表的所有博客
	public function userBlog($name)
	{
		return $this->where("author='$name' and rid=0")->order('bid desc')->select(MYSQLI_ASSOC);
	}

	//修改某条博客对应的浏览量，即浏览量加1
	public function updateLooks($bid)
	{
		$dt = $this->where("bid='$bid'")->select(MYSQLI_ASSOC)[0];
		$data['looks'] = $dt['looks']+1;
		return $this->where("bid='$bid'")->update($data);
	}
	//修改某条博客对应的评论数，即评论数加1
	public function updateReplys($bid)
	{
		$dt = $this->where("bid='$bid'")->select(MYSQLI_ASSOC)[0];
		
		$data['replys'] = $dt['replys']+1;
		return $this->where("bid='$bid'")->update($data);
	}
	


}