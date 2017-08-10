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
	<div id="templatemo_header">
    	<div id="site_title"><a href="index.php" title="博客乐园">博客乐园</a></div>
        <div id="templatemo_menu" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php" class="selected">首页</a></li>
                <li><a href="">关于</a>
                    <ul>
                        <li><a href="#">Sub Page One</a></li>
                        <li><a href="#">Sub Page Two</a></li>
                        <li><a href="#">Sub Page Three</a></li>
                  </ul>
                </li>
                <li><a href="portfolio.html">画廊</a>
                    <ul>
                        <li><a href="#">Page Link One</a></li>
                        <li><a href="#">Link Two</a></li>
                        <li><a href="#">Page Link Three</a></li>
                        <li><a href="#">Link Four</a></li>
                        <li><a href="#">Page Link Five</a></li>
                  </ul>
                </li>
                <li><a href="index.php?c=blog&a=blog">博客</a></li>
                <li><a href="contact.html">联系</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of templatemo_menu -->
    </div> <!-- END of header -->
    
    <div id="templatemo_page_intro">
    	<h1>我的博客</h1>
        <p>&nbsp;&nbsp;生活中意想不到的事，逗趣开心的事，工作中解决问题的方法，遇到的难题等等，不要吝啬，拿起我们的博客，随笔记录下来！点滴生活记录，从博客乐园开始，回首往昔，定会回味无穷！！！</p>
    </div>
    
    
    <div id="templatemo_main">
    	<div id="templatemo_content" class="left">
            <div class="post-item">

            	<div class="post-meta">
                	<img src="public/index/images/author.png" alt="post author image" />
                    <div class="post-meta-content">
                    	<h2>标题1</h2>
                        发表于<span><font color="#90C53D">Admin</font></span>
                        | <span><font color="#90C53D">2017-06-06</font></a></span>
                    </div>
                    <span class="post_comment">1</span>
				</div>
                <div class="img_border_b" >
                    <p>显示内容</p>
                    <p>显示内容</p>
                    <p>显示内容</p>

                </div>          
			</div>
            
            <h3>评论区</h3>
            <ol class="comment_list">
            <li></li> 
            <li>
                <div class="comment_box">
                    <img src="public/index/images/avator.jpg" alt="" class="img_fl img_border" />
                    <div class="comment_content">
                        <div class="comment_meta"><strong><a href="#">评论人</a></strong><br />
                       评论于 &nbsp;<font color="#90C53D"> 2017-06-06 12:12:12</font></a></div>
                        <p>评论内容</p>
                        <a href="#" class="more">回复</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
            <li>
                <div class="comment_box">
                    <img src="public/index/images/avator.jpg" alt="" class="img_fl img_border" />
                    <div class="comment_content">
                        <div class="comment_meta"><strong><a href="#">Ronald Duck</a></strong><br />
                        Posted on 22 January 2084 [10:12 AM]</div>
                        <p>Nulla ut accumsan magna, in commodo erat. Maecenas sed malesuada lacus. Nam mi sem, fringilla in erat ut, aliquam rhoncus neque. Nulla laoreet ante ac eros imperdiet blandit.</p>
                        <a href="#" class="more">Reply</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
        </ol>
        
            <div class="clear"></div>

            <div class="templatemo_paging">
                <ul>
                    <li><a  href="" target="_parent"><<</a></li>
                    <li><a  href="" target="_parent">1</a></li>
                    <li><a  href="" target="_parent">2</a></li>
                    <li><a  href="" target="_parent">3</a></li>
                    <li><a  href="" target="_parent">4</a></li>
                    <li><a  href="" target="_parent">5</a></li>
                    <li><a  href="" target="_parent">6</a></li>
                    <li><a  href="" target="_parent">>></a></li>
                </ul>
                <div class="clear"></div>
            </div>

            <div id="comment_form">
            <hr/>
            <h3>留下你的评论</h3>
                <form action="#" method="post">
                    <div class="form_row">
                        <label>Comment</label><br />
                        <textarea  name="comment" rows="" cols=""></textarea>
                    </div>

                    <input type="submit" name="Submit" value="提交" class="submit_btn" />
                </form>
            
            </div>
            
        </div> <!-- END of content -->
                
		<div id="templatemo_sidebar" class="right">
			
			<div class="sidebar_section sidebar_section_bg">
                <h3>Categories</h3>
                <ul class="sidebar_link_list">
                    <li><a href="#">Consectetur adipiscing</a></li>
                    <li><a href="#">Nullam vulputate est</a></li>
                    <li><a href="#">Duis porta velit</a></li>
                    <li><a href="#">Pretium suscipit</a></li>
                    <li><a href="#">Cras pulvinar eget lacus</a></li>
                    <li><a href="#">Duis in libero est</a></li>
                    <li><a href="#">Aenean tincidunt</a></li>
                    <li><a href="#">Morbi tempus iaculis</a></li>
                </ul>
			</div>
            
            <div class="sidebar_section sidebar_section_bg">
                <h3>Recent Comments</h3>
                <ul class="sidebar_link_list comment">
                    <li>
                    	<span>Donec rhoncus, neque quis dapibus dapibus, lorem tortor semper est...</span>
                        <span class="comment_meta">
		                    <strong>Van</strong> on <a href="#">Quisque dolor dolor</a>
						</span>
					</li>
                    <li>
                    	<span>Donec rhoncus, neque quis dapibus dapibus, lorem tortor semper est...</span>
                        <span class="comment_meta">
		                    <strong>George</strong> on <a href="#">Curabitur Mollis Justo</a>
						</span>
					</li>
                    <li>
                    	<span>Donec rhoncus, neque quis dapibus dapibus, lorem tortor semper est...</span>
                        <span class="comment_meta">
		                    <strong>Walker</strong> on <a href="#">Praesent venenatis ante neque</a>
						</span>
					</li>
                    <li>
                    	<span>Donec rhoncus, neque quis dapibus dapibus, lorem tortor semper est...</span>
                        <span class="comment_meta">
		                    <strong>David</strong> on <a href="#">Etiam dictum pulvinar neque</a>
						</span>
					</li>
                    <li>
                    	<span>Donec rhoncus, neque quis dapibus dapibus, lorem tortor semper est...</span>
                        <span class="comment_meta">
		                    <strong>Zoom</strong> on <a href="#">Maecenas fringilla felis quis</a>
						</span>
					</li>
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
            <a href="portfolio.html" class="more">View all</a>
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