<?php

namespace index\controller;
use index\model\Blog;
use index\model\UserModel;

class BlogController extends BaseController
{
	protected $blog;//博客内容model
	protected $user;//用户model
	protected $all;
	protected $allUser;
	protected $newBlog;
	protected $newComment;

	//通过初始化生成相应的model对象
	public function _init()
	{
		$this->blog = new Blog();
		$this->user = new UserModel();
		//找出博客列表中所有的博客
		$this->all = $this->blog->blogAll();
		//找出用户列表中所有的用户
		$this->allUser = $this->user->userList();
		//最新发表的博客
		$this->newBlog = $this->blog->newBlog();
		//最近发表的评论
		$this->newComment = $this->blog->newComment();
	}

	//博客列表页面
	public function blog()
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

		$this->assign('all',$this->all);
		$this->assign('allUser',$this->allUser);
		$this->assign('newBlog',$this->newBlog);
		$this->assign('newComment',$this->newComment);

		//加载博客内容列表页面
		$this->display();

	}

	//看博客含评论页面
	public function detail()
	{

		if(empty($_SESSION['user']))
		{
			$this->error('请先进行登录！');
		}else{
			$bid = $_GET['bid'];

			//修改该博客的浏览量，即浏览量加1
			$result = $this->blog->updateLooks($bid);
			if(!$result){
				$this->error('修改该博客的浏览量失败！！');
			}else{
					//向html页面传送某一条博客的内容变量
					$content = $this->blog->getByBid($bid)[0];
					$result = $this->assign('content',$content);

					if(empty($_GET['page']))
					{
						$p=1;
					}else{
						$p =(int)$_GET['page'];
					}
					$bid = $_GET['bid'];

					$result = $this->blog->blogComment($bid);
					$obj = $result[0];
					$comment = $result[1];
					
					$arr = $obj->allPage();
					// var_dump($arr);exit;
					$curPage = $obj->curPage; 
					$totalPage = $obj->totalPage; 
					
					//向html页面传送某一条博客的下的所有评论内容
					$this->assign('comment',$comment);

					//向html页面传送分页变量
					$this->assign('p',$p);
					$this->assign('bid',$bid);
					$this->assign('arr',$arr);
					$this->assign('curPage',$curPage);
					$this->assign('totalPage',$totalPage);

					$this->assign('all',$this->all);
					$this->assign('allUser',$this->allUser);
					$this->assign('newBlog',$this->newBlog);
					$this->assign('newComment',$this->newComment);

					//加载某一条博客的详细内容页面及评论
					$this->display();

					}	
		}	
	} 
	//写博客页面
	public function writeBlog()
	{
		if(empty($_SESSION['user']))
		{
			$this->error('请先进行登录！');
		}else{

			$this->assign('all',$this->all);
			$this->assign('newBlog',$this->newBlog);
			$this->assign('newComment',$this->newComment);

			//加载写博客页面
			$this->display();
		}	
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
				$this->success('发表博客成功！',"index.php?c=blog&a=detail&bid=$result");
			}else{
				$this->error('发表博客失败！');
			}

		}
		
	}
	//处理发表的对应博客下的评论
	public function deal_comment()
	{
		if(empty(trim($_POST['comment'])))
		{
			$this->error('评论内容不能为空！');
		}else{
			$bid = $_POST['bid'];
			$result = $this->blog->insertComment($_POST);
			if(!$result){
				$this->error('发表评论失败！');

			}else{
				//修改该博客的评论数，即评论数加1
				$re = $this->blog->updateReplys($bid);
				if(!$re){
					$this->error('修改该博客的评论数失败！！');
				}else{
					$this->success('发表评论成功！',"index.php?c=blog&a=detail&bid={$bid}");
				}
			}
		}	
		
	}

}
