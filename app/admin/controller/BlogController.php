<?php

namespace admin\controller;
use admin\model\Blog;
use admin\model\UserModel;

class BlogController extends BaseController
{
	protected $blog;//博客内容model

	public function _init()
	{
		$this->blog = new Blog();
	}
	//加载写文章页面
	public function write()
	{
		$this->display();
	}

	//加载修改文章页面
	public function update()
	{
		
		$id= (int)$_GET['id'];
		$data = $this->blog->getByBid($id)[0];
		$this->assign('data',$data);
		$this->display();
	}

	//处理写的博客内容
	public function deal_write()
	{
		// var_dump($_POST);exit;
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		if( empty($title) || empty($content))
		{
			$this->error('发表的博客标题和内容都不能为空！');
		}else{
			$result = $this->blog->insertBlog($_POST);
			if($result)
			{
				$this->success('发表博客成功！',"index.php?m=admin&c=blog&a=contentSet");
			}else{
				$this->error('发表博客失败！');
			}

		}
		
	}

	//处理修改的博客内容
	public function deal_update()
	{
		// var_dump($_POST);exit;
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		if( empty($title) || empty($content))
		{
			$this->error('修改的博客标题和内容都不能为空！');
		}else{
			$result = $this->blog->updateBlog($_POST);
			if($result)
			{
				$this->success('修改博客成功！');
			}else{
				$this->error('修改博客失败！');
			}

		}
		
	}

	//按分页加载文章管理页面
	public function contentSet()
	{
		if(empty($_GET['page']))
		{
			$p=1;
		}else{
			$p =(int)$_GET['page'];
		}
		$result = $this->blog->blogList();
		$obj = $result[0];
		$content = $result[1];

		$arr = $obj->allPage();
		// var_dump($arr);exit;
		$curPage = $obj->curPage; 
		$totalPage = $obj->totalPage; 
		
		//向html页面传送所有的博客内容变量
		$this->assign('content',$content);

		//向html页面传送分页变量
		$this->assign('p',$p);
		$this->assign('arr',$arr);
		$this->assign('curPage',$curPage);
		$this->assign('totalPage',$totalPage);

		//加载文章列表页面
		$this->display();
	}

	//加载评论管理页面
	public function commentSet()
	{
		$all = $this->blog->blogAll();
		$this->assign('all',$all);

		if(empty($_GET['page']))
		{
			$p=1;
		}else{
			$p =(int)$_GET['page'];
		}
		$result = $this->blog->commentList();
		$obj = $result[0];
		$comment = $result[1];

		$arr = $obj->allPage();
		// var_dump($arr);exit;
		$curPage = $obj->curPage; 
		$totalPage = $obj->totalPage; 
		
		//向html页面传送所有的评论内容变量
		$this->assign('comment',$comment);

		//向html页面传送分页变量
		$this->assign('p',$p);
		$this->assign('arr',$arr);
		$this->assign('curPage',$curPage);
		$this->assign('totalPage',$totalPage);

		//加载所有评论列表页面
		$this->display();
	}

	//删除评论
	public function deleteComment()
	{
		// var_dump($_POST);exit;
		if(empty($_POST))
		{
			$this->error('请选择您要删除的选项！！');
		}else{
			$arr = $_POST['id'];
			$result = $this->blog->delComment($arr);
			if($result){
				
				$this->success('删除评论成功！！');
			}else{
				$this->error('删除评论失败！！');
			}

		}
		
	}

	//删除文章
	public function deleteContent()
	{
		// var_dump($_POST);exit;
		if(empty($_POST))
		{
			$this->error('请选择您要删除的选项！！');
		}else{
			$arr = $_POST['id'];
			$result = $this->blog->delContent($arr);
			if($result){
				$this->success('删除文章成功！！');
			}else{
				$this->error('删除文章失败！！');
			}

		}
		
	}
	

	

}
