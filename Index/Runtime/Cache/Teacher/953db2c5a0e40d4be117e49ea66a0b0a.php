<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="程序设计考试 山东工商学院">
	<meta name="keywords" content="Exam,SDIBT,山东工商学院,程序设计考试">
	<!-- yours css -->
	<link rel="stylesheet" type="text/css" href="/stuexam/Public/Css/examsys.min.css" />
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="/stuexam/Public/Css/bootstrap.min.css" />
	<!--[if lt IE 9]>
		<script src="/stuexam/Public/Js/html5shiv.min.js"></script>
		<script src="/stuexam/Public/Js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top navbar-default exam_header" role="navigation">
  <div class="container">
  	<div class="navbar-header">
  	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
  	  data-target="#header-navbar">
  	  	<span class="sr-only">header toggle</span>
  	  	<span class="icon-bar"></span>
  	  	<span class="icon-bar"></span>
  	  	<span class="icon-bar"></span>
  	  </button>
  	  <a href="#" class="navbar-brand exam_navbar-brand">程序设计考试后台管理</a>
  	</div> <!-- navbar-header-end -->
	<div class="collapse navbar-collapse" id="header-navbar">
	<ul class="nav navbar-nav">
	  <li id='navexam'><a href="<?php echo U('/Teacher');?>">考试管理</a></li>
	  <li id='navchoose'><a href="<?php echo U('Teacher/Index/choose');?>">选择题管理</a></li>
	  <li id='navjudge'><a href="<?php echo U('Teacher/Index/judge');?>">判断题管理</a></li>
	  <li id='navfill'><a href="<?php echo U('Teacher/Index/fill');?>">填空题管理</a></li>
	  <li id='navpoint'><a href="<?php echo U('Teacher/Index/point');?>">知识点管理</a></li>
	  <li><a href="<?php echo U('/Home');?>">退出管理页面</a></li>
	</ul> <!-- first ul end -->
	<ul class="nav navbar-nav navbar-right">
		<li><a href="javascript:;">欢迎您： <?php echo (session('user_id')); ?></a></li>
	</ul> <!-- the second ul end -->
   </div> <!-- collapse navbar-collapse end -->
  </div> <!-- container-fluid end -->
</div> <!-- navbar end -->

<script type="text/javascript" src="/stuexam/Public/Js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/stuexam/Public/Js/Teacher.min.js"></script>
<script>
	$(function(){
		var url = window.location.href;
		if(url.indexOf('fill')!=-1){
			$("#navfill").addClass('active');
		}
		else if(url.indexOf('choose')!=-1){
			$("#navchoose").addClass('active');
		}
		else if(url.indexOf('judge')!=-1){
			$("#navjudge").addClass('active');
		}
		else if(url.indexOf('point')!=-1){
			$("#navpoint").addClass('active');
		}
		else{
			$("#navexam").addClass('active');
		}
	});
</script>

<div class="container exam_content">
	<form class='form-inline'>
	<input type="hidden" name="page" value="<?php echo ($mypage['page']); ?>" >
	<input type="hidden" name="problem" value="<?php echo ($problem); ?>" >
	<div class="form-group">
		<input type="text" class="form-control input-lg search-input" id="search" name='search' value="<?php echo ($search); ?>" placeholder="查询创建者或考试名称">
	</div>
	<button type="submit" class="btn btn-default btn-lg">Search</button>
	</form>
	<div class='row'>
		<div class="col-md-3"><h1>选择题库总览</h1></div>
		<div class='col-md-2'>
			<h1><a href="<?php echo U('Teacher/Add/choose',array('page'=>$mypage['page']));?>" class='btn btn-info'>添加选择题</a></h1>
		</div>
		<div class="col-md-2">
			<h1><input type="button" value="查看公共题库" class="btn btn-default" onclick="window.location.href='?problem=0'"></h1>
		</div>
		<div class="col-md-2">
			<h1><input type="button" value="查看私人题库" class="btn btn-default" onclick="window.location.href='?problem=1'"></h1>
		</div>
		<?php if($isadmin == true): ?><div class="col-md-2">
				<h1><input type="button" value="查看隐藏题库" class="btn btn-default" onclick="window.location.href='?problem=2'"></h1>
			</div><?php endif; ?>
	</div>
	<table class="table table-hover table-bordered table-condensed">
		<thread>
			<th width=4%>ID</th>
			<th width=30%>题目描述</th>
			<th width=8%>创建者</th>
			<th width=8%>知识点</th>
			<th width=4%>难度</th>
			<th width=8% colspan="2">操作</th>
		</thread>
		<tbody>
			<?php if(is_array($row)): foreach($row as $k=>$r): ?><tr>
					<td><?php echo ($numofchoose+$k); ?></td>
					<td align='left'><?php echo (cutstring($r['question'])); ?>...
			     <a tabindex="0" class="pull-right btn btn-xs btn-danger" role="button" data-toggle="popover" data-trigger="focus" data-content="<?php echo ($r['question']); ?>">展开>></a>		
                               <!-- <button type="button" 
          			class="pull-right btn btn-danger btn-xs" 
					data-toggle="tooltip" 
					data-placement="right" 
					data-original-title="<?php echo (htmlspecialchars($r['question'])); ?>">展开>></button> -->
					</td>
					<div class="clearfix"></div>
					<td><?php echo ($r['creator']); ?></td>
					<td><?php echo ($r['point']); ?></td>
					<td><?php echo ($r['easycount']); ?></td>
					<td><a href="javascript:suredo('<?php echo U('Teacher/Del/choose',array('id'=>$r['choose_id'],'getkey'=>$mykey,'page'=>$mypage['page']));?>','确定删除?')">删除</a></td>
					<td><a href="<?php echo U('Teacher/Add/choose',array('id'=>$r['choose_id'],'page'=>$mypage['page']));?>">编辑</a></td>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	<?php echo (showpagelast($mypage,U("Teacher/Index/choose"),"search=$search&problem=$problem")); ?>
</div>
<script>
$(function(){
	//$('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
});
</script>

<style>
#examFooter, #examFooter ul li {
	background-color: #252525;
	text-align: center;
}
#examFooter .container {
	padding-top: 30px;
}
#examFooter ul li {
border: none;
color:white;
      font-size: 20px;
}
#examFooter ul li a , #examFooter p{
	font-size: 15px;
color : #959595;
}
</style>
<footer id="examFooter">
<div class="container">
<ul class="list-group col-md-4">
<li class="list-group-item">下载链接</li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/download/Firefox.exe">Firefox</a></li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/download/codeblocks-12.11mingw-setup.exe">CodeBlocks for Win</a></li>
</ul>
<ul class="list-group col-md-4">
<li class="list-group-item">主站导航</li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/JudgeOnline/faqs.php">F.A.Qs</a></li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/JudgeOnline/contest.php">Contest</a></li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/JudgeOnline/ranklist.php">Ranklist</a></li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/JudgeOnline/problemset.php">ProblemSet</a></li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/JudgeOnline/stuexam/">Examination</a></li>
</ul>
<ul class="list-group col-md-3">
<li class="list-group-item">关于我们</li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/blog/">博客</a></li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn/ranklist/">省赛排名</a></li>
<li class="list-group-item"><a href="http://acm.sdibt.edu.cn:8001">训练计划</a></li>
</ul>
<div class="col-md-offset-2 col-md-8">
<p>@Copyright&copy;SDIBT_ACM | Any Problems, Please Contact Admin:<a href="mailto:sdibtacm@126.com">admin</a></p>
</div>
</div>
</footer>
<script type="text/javascript" src="/stuexam/Public/Js/bootstrap.min.js"></script>
</body>
</html>