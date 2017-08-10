<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>博客详情</title>
<meta name="keywords" content="runner, blog posts, free template, CSS, HTML" />
<meta name="description" content="Runner, Blog Posts, free blog template by templatemo.com" />
<link href="public/index/templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="public/index/css/orman.css" type="text/css" media="screen" />
<link rel="stylesheet" href="public/index/css/nivo-slider.css" type="text/css" media="screen" />	

<link rel="stylesheet" type="text/css" href="public/index/css/ddsmoothmenu.css" />

<script type="text/javascript" src="public/index/js/jquery.min.js"></script>
<script type="text/javascript" src="public/index/js/ddsmoothmenu.js">

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<link rel="stylesheet" href="public/index/css/slimbox2.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="public/index/js/slimbox2.js"></script> 

</head>
<body id="subpage">

<div id="templatemo_wrapper">
	 <?php include 'cache/index/public_html.php';?>
    
    <div id="templatemo_page_intro">
    	<h1>我的博客</h1>
        <p>&nbsp;&nbsp;生活中意想不到的事，逗趣开心的事，工作中解决问题的方法，遇到的难题等等，不要吝啬，拿起我们的博客，随笔记录下来！点滴生活记录，从博客乐园开始，回首往昔，定会回味无穷！！！</p>
    </div>
    
    <div id="templatemo_main">
    	<div id="templatemo_content" class="left">
            <div class="post-item">

            	<div class="post-meta">
                	<?php foreach ($allUser as $vv): ?>
                        <?php if ($content['author'] == $vv['username']): ?>

                            <?php if ($vv['touxiang'] == ''): ?>
                            <img src="public/index/images/tou.png" alt="post author image" />
                            <?php else: ?>
                            <img style="width: 50px;
                                        height: 50px;"
                                        src="<?=$vv['touxiang']; ?>" alt="post author image" />
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="post-meta-content">
                    	<h2><?=$content['title']; ?></h2>
                        发表于<span><font color="#90C53D"><?=$content['author']; ?></font></span>
                        | <span><font color="#90C53D"><?=$content['time']; ?></font></a></span>
                        <br/>浏览量：<?=$content['looks']; ?> &nbsp;&nbsp;&nbsp;评论数：<?=$content['replys']; ?>
                    </div>
                    
				</div>
                <div class="img_border_b" >
                    <p><?=$content['content']; ?></p>

                </div>          
			</div>
             
            <h3>评论区</h3>
            <ol class="comment_list">
            <li></li>
            <?php if (!$comment): ?>
            <li>
                <div class="comment_box">
                    暂时未有人进行评论
                    <div class="clear"></div>
                </div>
            </li>
            <?php else: ?>
            <?php foreach ($comment as $v): ?>
            <li>
                <div class="comment_box">
                    <?php foreach ($allUser as $vv): ?>
                        <?php if ($v['author'] == $vv['username']): ?>

                            <?php if ($vv['touxiang'] == ''): ?>
                            <img src="public/index/images/tou.png" alt="post author image" />
                            <?php else: ?>
                            <img style="width: 80px;
                                        height: 80px;"
                                        src="<?=$vv['touxiang']; ?>" alt="post author image" />
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="comment_content">
                        <div class="comment_meta"><strong><a href="#"><?=$v['author']; ?></a></strong><br />
                       评论于 &nbsp;<font color="#90C53D"> <?=$v['time']; ?></font></a></div>
                        <p><?=$v['content']; ?></p>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
            <?php endforeach; ?>
            <?php endif; ?> 
            </ol>
            <div class="clear"></div>

            <?php if ($comment): ?>
            <div class="templatemo_paging">
                <ul>
                    <li><a  href="<?=$arr['first'];?>" >首页</a></li>
                    <li><a  href="<?=$arr['pre'];?>" >上一页</a></li>

                    <?php if ($p<=$totalPage): ?>
                    <li><a  href="index.php?c=blog&a=detail&bid=<?=$bid; ?>&page=<?=$p;?>"><?=$p; ?></a></li>
                    <?php endif; ?>
                    <?php if ($p+1<=$totalPage): ?>
                    <li><a  href="index.php?c=blog&a=detail&bid=<?=$bid; ?>&page=<?=$p+1;?>"><?=$p+1; ?></a></li>
                    <?php endif; ?>
                    <?php if ($p+2<=$totalPage): ?>
                    <li><a  href="index.php?c=blog&a=detail&bid=<?=$bid; ?>&page=<?=$p+2;?>"><?=$p+2; ?></a></li>
                    <?php endif; ?>
                    <li><a  href="<?=$arr['next'];?>" >下一页</a></li>
                    <li><a  href="<?=$arr['last'];?>" >尾页</a></li>
                    当前页码为：<?=$curPage; ?>
                    <br/>共有<?=$totalPage; ?>页
                </ul>
                <div class="clear"></div>
            </div>
            <?php endif; ?>

            <div id="comment_form">
            <hr/>
            <h3>留下你的评论</h3>
                <form action="index.php?c=blog&a=deal_comment" method="post">
                    <input type="hidden" name="bid" value="<?=$content['bid']; ?>">
                    <input type="hidden" name="author" value="<?=$_SESSION['user']; ?>">
                    <div class="form_row">
                        <label>Comment</label><br />
                        <textarea  name="comment" rows="" cols=""></textarea>
                    </div>

                    <input type="submit" value="提交" class="submit_btn" />
                </form>
            
            </div>
            
        </div> <!-- END of content -->
                
		<div id="templatemo_sidebar" class="right">
			
			<div class="sidebar_section sidebar_section_bg">
                <h3>最新发表的文章</h3>
                <ul class="sidebar_link_list">
                    <?php foreach ($newBlog as $v): ?>
                   <a href="index.php?c=blog&a=detail&bid=<?=$v['bid'];?>"><li><font size="3"><?=$v['title']; ?></font>
                    <br/>发表人：<font color="red"><?=$v['author'];?></font>
                    </li></a>
                    <?php endforeach; ?>
                    
                </ul>
            </div>
            
            <div class="sidebar_section sidebar_section_bg">
                <h3>最近的评论</h3>
                <ul class="sidebar_link_list comment">
                    <?php foreach ($newComment as $v): ?>
                    <li>
                        <span class="comment_meta">
                            <strong><font color="red"><?=$v['author']; ?></font></strong>&nbsp;&nbsp;对文章&nbsp;&nbsp;
                            <?php foreach ($all as $vv): ?>
                                <?php if ($v['rid'] == $vv['bid']): ?>
                            <strong><font color="red"><?=$vv['title']; ?></font></strong>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            评论：
                            <p></p>
                        <span><?=$v['content']; ?></span>
                        <p></p>
                        <span><?=$v['time']; ?></span>
                        </span>
                    </li>
                    <?php endforeach; ?>
                    
                </ul>
            </div>
            
      </div>
        
        <div class="clear"></div>
                
    </div> <!-- END of main -->
</div> <!-- END of wrapper -->

<div id="templatemo_bottom_wrapper">
	<div id="templatemo_bottom">
    	
        <div class="col col_3">
            <h4>Photo Gallery</h4>
            <ul class="nobullet footer_gallery">
                <li><a href="public/index/images/portfolio/02.jpg" rel="lightbox[gallery]"><img src="public/index/images/templatemo_image_02.png" alt="image 2" /></a></li>
                <li><a href="public/index/images/portfolio/03.jpg" rel="lightbox[gallery]"><img src="public/index/images/templatemo_image_03.png" alt="image 3" /></a></li>
                <li><a href="public/index/images/portfolio/04.jpg" rel="lightbox[gallery]"><img src="public/index/images/templatemo_image_04.png" alt="image 4" /></a></li>
                <li><a href="public/index/images/portfolio/05.jpg" rel="lightbox[gallery]"><img src="public/index/images/templatemo_image_05.png" alt="image 5" /></a></li>
                <li><a href="public/index/images/portfolio/03.jpg" rel="lightbox[gallery]"><img src="public/index/images/templatemo_image_06.png" alt="image 6" /></a></li>
                <li><a href="public/index/images/portfolio/01.jpg" rel="lightbox[gallery]"><img src="public/index/images/templatemo_image_07.png" alt="image 7" /></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    	
        <div class="col col_3">
        	<h4>Twitter</h4>
      		<ul class="nobullet twitter">
                <li><a href="#">@网站模板</a> Proin turpis nisi, placerat quis orci ac, tempor iaculis eros.</li>
                <li>Suspendisse enean <a href="#">#FREE</a> website template, mi lacus gravida nisi, vitae commodo orci nisi non nulla.</li>
                <li>Sed non varius lorem, in sollicitudin lectus. Cras vel urna a urna gravida consequat. Curabitur non risus dui. <a  href="#">#</a></li>
                <li><a href="#" title="" class="rower"  target="_blank"></a></li>
            </ul>
        </div>
        
        <div class="col col_3 no_mr">
        	<h4>Follow Us</h4>
            <ul class="nobullet social">
            	<li><a  href="#/templatemo" class="facebook">Facebook</a></li>
                <li><a href="#" class="twitter">Twitter</a></li>
                <li><a href="#" class="youtube">Youtube</a></li>
                <li><a href="#" class="google">Google+</a></li>
                <li><a href="#" class="vimeo">Vimeo</a></li>
                <li><a href="#" class="skype">Skype</a></li>
            </ul>
        </div>
        
        <div class="clear"></div>
    </div> <!-- END of bottom -->
    
</div> <!-- END of bottom wrapper -->

<div id="templatemo_footer_wrapper">
	<div id="templatemo_footer">
    	Copyright © 2084 Company Name | More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> | Collect from <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a>
    </div> <!-- END of footer -->
</div> <!-- END of footer wrapper -->

</body>
<script type='text/javascript' src='js/logging.js'></script>
</html>