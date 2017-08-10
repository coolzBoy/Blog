<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="public/admin/css/pintuer.css">
<link rel="stylesheet" href="public/admin/css/admin.css">
<script src="public/admin/js/jquery.js"></script>
<script src="public/admin/js/pintuer.js"></script>
</head>
<body>
<form method="post" action="index.php?m=admin&c=blog&a=deleteContent" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder">文章列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
          <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
        </li>
        <li> <a class="button border-main icon-plus-square-o" href="index.php?m=admin&c=blog&a=write"> 添加内容</a> </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="10%">标题</th>
        <th>浏览数</th>
        <th>评论数</th>
        <th>作者</th>
        <th width="10%">发表时间</th>
        <th>操作</th>
      </tr>
      <volist name="list" id="vo">

        <?php foreach ($content as $v): ?>
        <tr>
          <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="<?=$v['bid']; ?>" /></td>
          <td><?=$v['title']; ?></td>
          <td><?=$v['looks']; ?></td>
          <td><?=$v['replys']; ?></td>
          <td><?=$v['author']; ?></td>
          <td><?=$v['time']; ?></td>
          <td>
            <div class="button-group">
              <a class="button border-main" href="index.php?m=admin&c=blog&a=update&id=<?=$v['bid']; ?>" target="right"><span class="icon-edit"></span>修改</a>
              <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 删除</button>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="8">
              <div class="pagelist">
                  <a  href="<?=$arr['first'];?>" >首页</a>
                  <a href="<?=$arr['pre'];?>" >上一页</a>
                    <?php if ($p<=$totalPage): ?>
                      <a href="index.php?m=admin&c=blog&a=contentSet&page=<?=$p;?>"><?=$p; ?></a>
                     <?php endif; ?>
                     <?php if ($p+1<=$totalPage): ?>
                    <a href="index.php?m=admin&c=blog&a=contentSet&page=<?=$p+1;?>"><?=$p+1; ?></a>
                    <?php endif; ?>
                    <?php if ($p+2<=$totalPage): ?>
                    <a href="index.php?m=admin&c=blog&a=contentSet&page=<?=$p+2;?>"><?=$p+2; ?></a>
                    <?php endif; ?>
                    <a href="<?=$arr['next'];?>" >下一页</a>
                    <a href="<?=$arr['last'];?>" >尾页</a>
              </div>
          </td>
        <tr>
          <td colspan="8">
            <div class="pagelist">
              当前页码为：<?=$curPage; ?>
              <br/>共有<?=$totalPage; ?>页
            </div>
          </td>
        </tr>  
    </table>
  </div>
</form>
<script type="text/javascript">

//搜索
function changesearch(){	
		
}

//单个删除
function del(id,mid,iscid){
	if(confirm("您确定要删除吗?")){
		
	}
}

//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

//批量删除
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;		
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

//批量排序
function sorts(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		return false;
	}
}


//批量首页显示
function changeishome(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}

//批量推荐
function changeisvouch(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");	
		
		return false;
	}
}

//批量置顶
function changeistop(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}


//批量移动
function changecate(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		
		return false;
	}
}

//批量复制
function changecopy(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		var i = 0;
	    $("input[name='id[]']").each(function(){
	  		if (this.checked==true) {
				i++;
			}		
	    });
		if(i>1){ 
	    	alert("只能选择一条信息!");
			$(o).find("option:first").prop("selected","selected");
		}else{
		
			$("#listform").submit();		
		}	
	}
	else{
		alert("请选择要复制的内容!");
		$(o).find("option:first").prop("selected","selected");
		return false;
	}
}

</script>
</body>
</html>