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

<link rel="stylesheet" href="public/md/examples/css/style.css" />
    <link rel="stylesheet" href="public/md/css/editormd.css" />

<script src="public/admin/js/jquery.js"></script>
<script src="public/admin/js/pintuer.js"></script>
</head>
<body> 
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-pencil-square-o"></span>修改博客</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="index.php?m=admin&c=blog&a=deal_update">
      <input type="hidden" name="id" value="<?=$data['bid']; ?>">     
      <div class="form-group">
        <div class="label">
          <label>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="title" value="<?=$data['title']; ?>" />
          <div class="tips"></div>
        </div>
      </div>
      
      <div class="form-group">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">


          <!-- <textarea name="content"></textarea> -->

          <div id="test-editormd">
                <textarea style="display:none;" name="content" ><?=$data['content']; ?></textarea>     
            </div>
            <script src="public/md/examples/js/jquery.min.js"></script>
    <script src="public/md/editormd.min.js"></script>
    <script type="text/javascript">
    var testEditor;

        $(function() {
            testEditor = editormd("test-editormd", {
                width   : "90%",
                height  : 500,
                syncScrolling : "single",
                path    : "public/md/lib/"
            });

        });
    </script>



          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body></html>