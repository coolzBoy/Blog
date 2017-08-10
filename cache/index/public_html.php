<div id="templatemo_menu" class="ddsmoothmenu">
        <ul>
            <?php if (empty($_SESSION['user'])): ?>
            <font color="red">游客</font>
            <li><a href="index.php?c=user&a=login"><font color="blue">登录</font></a></li>
            <li><a href="index.php?c=user&a=register"><font color="blue">注册</font></a></li>
            <?php elseif(($_SESSION['user'] == 'admin')):?>
            <font color="red">管理员</font>
            <li><a href="index.php?c=user&a=person"><font color="blue"><?=$_SESSION['user']; ?></font></a></li>
            <li><a href="index.php?m=admin&c=user&a=login"><font color="blue">文章管理</font></a></li>
            <li><a href="index.php?c=user&a=exit"><font color="blue">退出</font></a></li>
            <?php else: ?>
            <font color="red">普通用户</font>
            <li><a href="index.php?c=user&a=person"><font color="blue"><?=$_SESSION['user']; ?></font></a></li>
            <li><a href="index.php?c=user&a=exit"><font color="blue">退出</font></a></li>
            <?php endif; ?>
        </ul>
</div>
<div id="templatemo_header">
	<div id="site_title"><a href="index.php" title="博客乐园">博客乐园</a></div>
    <div id="templatemo_menu" class="ddsmoothmenu">
        <ul>
            <li><a href="index.php" class="selected">首页</a></li>
            <li><a href="index.php?a=gallery">画廊</a></li>
            <li><a href="index.php?c=blog&a=blog">博客</a>
                <ul>
                    <li><a href="index.php?c=blog&a=writeBlog">写博客</a></li>
                    <li><a href="index.php?c=blog&a=blog">看博客</a></li>
                    
              </ul>
            </li>

        </ul>
        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->
</div> <!-- END of header -->